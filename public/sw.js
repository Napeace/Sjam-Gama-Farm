// Service Worker for SJAM GAMA FARM Push Notifications
// File: public/sw.js

self.addEventListener('install', event => {
    console.log('Service worker has been installed');
    self.skipWaiting();
});

self.addEventListener('activate', event => {
    console.log('Service worker has been activated');
    return self.clients.claim();
});

// Listen for push events
self.addEventListener('push', event => {
    if (!event.data) {
        console.log('Push event but no data');
        return;
    }

    // Get the notification data from the server
    const data = event.data.json();

    const options = {
        body: data.body || data.message,
        icon: data.icon || '/images/logo.png', // Default icon
        badge: '/images/badge.png', // Small icon for notification tray
        image: data.image,
        data: {
            url: data.action_url || data.url || '/' // URL to open when notification is clicked
        },
        vibrate: [100, 50, 100],
        actions: []
    };

    // If there's a specific action
    if (data.action) {
        options.actions.push({
            action: 'open-action',
            title: data.action
        });
    }

    // Show the notification
    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

// Handle notification click
self.addEventListener('notificationclick', event => {
    event.notification.close();

    // Get the URL to open
    const urlToOpen = event.notification.data.url || '/';

    // Open a window/tab with the URL
    event.waitUntil(
        clients.openWindow(urlToOpen)
    );
});

// Handle push subscription change
self.addEventListener('pushsubscriptionchange', event => {
    console.log('Subscription expired');
    event.waitUntil(
        self.registration.pushManager.subscribe({ userVisibleOnly: true })
            .then(subscription => {
                console.log('Subscribed after expiration', subscription);

                // Get the CSRF token and re-send the subscription to the server
                return fetch('/notifications/subscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(subscription)
                });
            })
    );
});
