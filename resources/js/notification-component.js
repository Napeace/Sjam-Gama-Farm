// File: resources/js/notification-component.js

// Register Alpine.js notification system component
document.addEventListener('alpine:init', () => {
    Alpine.data('notificationSystem', () => ({
        showNotifs: false,
        notifCount: 0,
        notifications: [],
        hasSubscribed: false, // Track if user has subscribed already
        showPermissionPrompt: false, // Control visibility of permission prompt

        init() {
            console.log('Notification system initialized');
            // Check if already subscribed
            this.checkSubscriptionStatus();

            // Fetch notifications if visitor_id cookie exists
            if (this.getCookie('visitor_id')) {
                this.fetchNotifications();
            }

            // Refetch notifications every minute if subscribed
            setInterval(() => {
                if (this.hasSubscribed) {
                    this.fetchNotifications();
                }
            }, 60000);
        },

        // Helper function to get cookie value
        getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        },

        checkSubscriptionStatus() {
            fetch('/notifications/check-subscription')
                .then(response => response.json())
                .then(data => {
                    console.log('Subscription status:', data);
                    this.hasSubscribed = data.subscribed;
                })
                .catch(error => {
                    console.error('Error checking subscription status:', error);
                });
        },

        handleBellClick() {
            console.log('Bell clicked, permission:', Notification.permission);
            // If not subscribed yet, show permission prompt instead of notifications
            if (!this.hasSubscribed && Notification.permission !== 'granted') {
                this.showPermissionPrompt = !this.showPermissionPrompt;
                this.showNotifs = false;
            } else {
                // Already subscribed, toggle notification panel
                this.showNotifs = !this.showNotifs;
                this.showPermissionPrompt = false;
            }
        },

        allowNotifications() {
            console.log('Allow notifications clicked');
            this.showPermissionPrompt = false;
            this.requestNotificationPermission();
        },

        denyNotifications() {
            console.log('Deny notifications clicked');
            this.showPermissionPrompt = false;
            // Store preference in localStorage to not ask again too soon
            localStorage.setItem('notification_prompt_dismissed', Date.now().toString());
        },

        requestNotificationPermission() {
            if (!('Notification' in window)) {
                alert('Browser Anda tidak mendukung notifikasi');
                return;
            }

            Notification.requestPermission().then(permission => {
                console.log('Notification permission:', permission);
                if (permission === 'granted') {
                    // Register service worker
                    this.registerServiceWorker();
                }
            });
        },

        registerServiceWorker() {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('Service Worker registered successfully');
                        // Subscribe to push notifications
                        this.subscribeToPushNotifications(registration);
                    })
                    .catch(error => {
                        console.error('Service Worker registration failed:', error);
                    });
            }
        },

        subscribeToPushNotifications(registration) {
            // Get the public key from meta tag
            const publicKey = document.querySelector('meta[name="vapid-public-key"]').getAttribute('content');

            if (!publicKey) {
                console.error('VAPID public key not found');
                return;
            }

            // Convert the key to the right format
            const applicationServerKey = this.urlBase64ToUint8Array(publicKey);

            // Check if we already have a subscription
            registration.pushManager.getSubscription()
                .then(subscription => {
                    if (subscription) {
                        console.log('Already subscribed to push notifications');
                        return subscription;
                    }

                    console.log('Creating new push subscription');
                    // Create a new subscription
                    return registration.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: applicationServerKey
                    });
                })
                .then(subscription => {
                    // Send the subscription to the server
                    return this.sendSubscriptionToServer(subscription);
                })
                .catch(error => {
                    console.error('Failed to subscribe to push notifications:', error);
                });
        },

        sendSubscriptionToServer(subscription) {
            // Get the CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            return fetch('/notifications/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(subscription)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to store subscription');
                }
                return response.json();
            })
            .then(data => {
                console.log('Subscription sent to server successfully');
                this.hasSubscribed = true;
                // Refresh notifications
                this.fetchNotifications();
            });
        },

        urlBase64ToUint8Array(base64String) {
            const padding = '='.repeat((4 - base64String.length % 4) % 4);
            const base64 = (base64String + padding)
                .replace(/\-/g, '+')
                .replace(/_/g, '/');

            const rawData = window.atob(base64);
            const outputArray = new Uint8Array(rawData.length);

            for (let i = 0; i < rawData.length; ++i) {
                outputArray[i] = rawData.charCodeAt(i);
            }
            return outputArray;
        },

        fetchNotifications() {
            fetch('/notifications')
                .then(response => response.json())
                .then(data => {
                    this.notifications = data.notifications;
                    this.notifCount = data.unread_count;
                })
                .catch(error => {
                    console.error('Error fetching notifications:', error);
                });
        },

        markAllAsRead() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.notifications.forEach(notification => {
                        notification.is_read = true;
                    });
                    this.notifCount = 0;
                }
            })
            .catch(error => {
                console.error('Error marking notifications as read:', error);
            });
        },

        openNotification(notification) {
            if (!notification.is_read) {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/notifications/${notification.id}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        notification.is_read = true;
                        this.notifCount = Math.max(0, this.notifCount - 1);
                    }
                })
                .catch(error => {
                    console.error('Error marking notification as read:', error);
                });
            }

            // Navigate to link URL if it exists
            if (notification.link_url) {
                window.location.href = notification.link_url;
            }

            // Close notification dropdown
            this.showNotifs = false;
        },

        formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const yesterday = new Date(now);
            yesterday.setDate(now.getDate() - 1);

            // Check if date is today
            if (date.toDateString() === now.toDateString()) {
                return 'Hari ini ' + date.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
            }

            // Check if date is yesterday
            if (date.toDateString() === yesterday.toDateString()) {
                return 'Kemarin ' + date.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
            }

            // Otherwise, return formatted date
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });
        }
    }));
});
