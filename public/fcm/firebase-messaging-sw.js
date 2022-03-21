/** Again import google libraries */
importScripts("https://www.gstatic.com/firebasejs/8.8.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.8.0/firebase-messaging.js");

/** Your web app's Firebase configuration
 * Copy from Login
 *      Firebase Console -> Select Projects From Top Naviagation
 *      -> Left Side bar -> Project Overview -> Project Settings
 *      -> General -> Scroll Down and Choose CDN for all the details
 */
/*
var firebaseConfig = {
    apiKey: "AIzaSyCBmgZnNMz9AX2y_p-Bu9OHR16jO1oYksg",
    authDomain: "pismart-dc999.firebaseapp.com",
    projectId: "pismart-dc999",
    storageBucket: "pismart-dc999.appspot.com",
    messagingSenderId: "614959217430",
    appId: "1:614959217430:web:c6754cdb7ef87a1dd52e37",
    measurementId: "G-YLSWTBWB20"
};*/

const firebaseConfig = {
    apiKey: "AIzaSyBWIoL5hNuyj2ZBsSNPeYSOeGosBQMmf2M",
    authDomain: "segments-98a92.firebaseapp.com",
    projectId: "segments-98a92",
    storageBucket: "segments-98a92.appspot.com",
    messagingSenderId: "281489048109",
    appId: "1:281489048109:web:4e5b8d39b6f2dd5db4eea4",
    measurementId: "${config.measurementId}",
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Retrieve an instance of Firebase Data Messaging so that it can handle background messages.
const messaging = firebase.messaging();

/** THIS IS THE MAIN WHICH LISTENS IN BACKGROUND */
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("background payload received : ");
    console.log(payload);
    const notificationTitle = "BACKGROUND MESSAGE TITLE";
    const notificationOptions = {
        body: "Data Message body",
        icon: "https://c.disquscdn.com/uploads/users/34896/2802/avatar92.jpg",
        image: "https://c.disquscdn.com/uploads/users/34896/2802/avatar92.jpg",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions
    );
});
