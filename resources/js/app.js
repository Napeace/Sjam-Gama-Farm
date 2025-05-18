import './bootstrap';
// Import Alpine.js notification component
import './notification-component';

// You can add other JS imports here if needed

// Initialize event listener for enabling web push subscription
document.addEventListener('DOMContentLoaded', function() {
    // Check for "Subscribe to Notifications" button if you have one
    const subscribeBtn = document.getElementById('subscribe-notifications');
    if (subscribeBtn) {
        subscribeBtn.addEventListener('click', requestNotificationPermission);
    }

    // Show notification permission request if not already requested
    // and user hasn't seen it recently
    const lastPrompt = localStorage.getItem('notification_prompt_dismissed');
    if (!lastPrompt || (Date.now() - parseInt(lastPrompt)) > (7 * 24 * 60 * 60 * 1000)) { // 7 days
        setTimeout(() => {
            if (Notification.permission !== 'granted' && Notification.permission !== 'denied') {
                showNotificationPrompt();
            }
        }, 5000); // Show after 5 seconds
    }
});

// Function to show notification permission prompt
function showNotificationPrompt() {
    // Only show if element doesn't already exist
    if (document.getElementById('notification-permission-prompt')) {
        return;
    }

    const container = document.createElement('div');
    container.id = 'notification-permission-prompt';
    container.classList.add('fixed', 'bottom-4', 'right-4', 'bg-white', 'rounded-lg', 'shadow-lg', 'p-4', 'max-w-xs', 'z-50');

    container.innerHTML = `
        <div class="flex flex-col gap-2">
            <div class="font-semibold text-gray-800">Info Terbaru SJAM GAMA FARM</div>
            <p class="text-sm text-gray-600">Aktifkan notifikasi untuk mendapatkan update terbaru seputar produk hidroponik dan peternakan.</p>
            <div class="flex gap-2 mt-2">
                <button id="allow-notifications" class="bg-green-600 text-white py-1 px-3 rounded text-sm">Aktifkan</button>
                <button id="dismiss-notification-prompt" class="bg-gray-200 text-gray-700 py-1 px-3 rounded text-sm">Nanti saja</button>
            </div>
        </div>
    `;

    document.body.appendChild(container);

    // Add event listeners
    document.getElementById('allow-notifications').addEventListener('click', () => {
        requestNotificationPermission();
        container.remove();
    });

    document.getElementById('dismiss-notification-prompt').addEventListener('click', () => {
        container.remove();
        localStorage.setItem('notification_prompt_dismissed', Date.now().toString());
    });
}

// Function to request notification permission
function requestNotificationPermission() {
    if (!('Notification' in window)) {
        alert('Browser Anda tidak mendukung notifikasi');
        return;
    }

    Notification.requestPermission().then(permission => {
        if (permission === 'granted') {
            // Register service worker
            registerServiceWorker();
        }
    });
}

// Function to register service worker
function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                // Successfully registered service worker
                // Subscribe to push notifications
                subscribeToPushNotifications(registration);
            })
            .catch(error => {
                console.error('Service Worker registration failed:', error);
            });
    }
}

// Function to subscribe to push notifications
function subscribeToPushNotifications(registration) {
    // Get the public key from meta tag
    const publicKey = document.querySelector('meta[name="vapid-public-key"]').getAttribute('content');

    // Convert the key to the right format
    const applicationServerKey = urlBase64ToUint8Array(publicKey);

    // Check if we already have a subscription
    registration.pushManager.getSubscription()
        .then(subscription => {
            if (subscription) {
                // Already subscribed
                return subscription;
            }

            // Create a new subscription
            return registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: applicationServerKey
            });
        })
        .then(subscription => {
            // Send the subscription to the server
            return sendSubscriptionToServer(subscription);
        })
        .catch(error => {
            console.error('Failed to subscribe to push notifications:', error);
        });
}

// Function to send subscription to server
function sendSubscriptionToServer(subscription) {
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
    });
}

// Helper function to convert base64 to Uint8Array
// (needed for the applicationServerKey)
function urlBase64ToUint8Array(base64String) {
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
}
