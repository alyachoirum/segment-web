// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
/*var firebaseConfig = {
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

/**
 * We can start messaging using messaging() service with firebase object
 */
var messaging = firebase.messaging();

console.log(messaging);

/** Register your service worker here
 *  It starts listening to incoming push notifications from here
 */
navigator.serviceWorker
    .register("./fcm/firebase-messaging-sw.js")
    .then(function (registration) {
        /** Since we are using our own service worker ie firebase-messaging-sw.js file */
        messaging.useServiceWorker(registration);

        /** Lets request user whether we need to send the notifications or not */
        messaging
            .requestPermission()
            .then(function () {
                /** Standard function to get the token */
                messaging
                    .getToken()
                    .then(function (token) {
                        /** Here I am logging to my console. This token I will use for testing with PHP Notification */
                        console.log("new token : " + token);
                        /** SAVE TOKEN::From here you need to store the TOKEN by AJAX request to your server */
                        // $.ajax({
                        //     url: base_url + "/notification/addtoken",
                        //     method: "POST",
                        //     dataType: "json",
                        //     data: {
                        //         token: token,
                        //     },
                        //     success: function (resp) {
                        //         console.log(resp);
                        //     },
                        //     error: function (jxhr) {
                        //         console.log(
                        //             "Failed to update token notification"
                        //         );
                        //     },
                        // });
                    })
                    .catch(function (error) {
                        /** If some error happens while fetching the token then handle here */
                        updateUIForPushPermissionRequired();
                        console.log("Error while fetching the token " + error);
                    });
            })
            .catch(function (error) {
                /** If user denies then handle something here */
                console.log("Permission denied " + error);
                messaging.requestPermission();
            });
    })
    .catch(function (error) {
        console.log(error);
        console.log("Error in registering service worker");
    });

/** What we need to do when the existing token refreshes for a user */
messaging.onTokenRefresh(function () {
    messaging
        .getToken()
        .then(function (renewedToken) {
            console.log("renew token :" + renewedToken);
            /** UPDATE TOKEN::From here you need to store the TOKEN by AJAX request to your server */
            // $.ajax({
            //     url: base_url + "/notification/refreshtoken",
            //     method: "POST",
            //     dataType: "json",
            //     data: {
            //         token: renewedToken,
            //     },
            //     success: function (resp) {
            //         console.log(resp);
            //     },
            //     error: function (jxhr) {
            //         console.log(jxhr);
            //         console.log("Failed to update token notification");
            //     },
            // });
        })
        .catch(function (error) {
            /** If some error happens while fetching the token then handle here */
            console.log("Error in fetching refreshed token " + error);
        });
});

// Handle incoming messages
messaging.onMessage(function (payload) {
    console.log("foreground payload received : ");
    console.log(payload);

    //create self notification inside app when receive foreground notification
    var content = {};
    content.message = payload.notification.body;
    content.title = payload.notification.title;
    content.url = payload.notification.click_action;
    content.target = "_self";

    var notify = $.notify(content, {
        type: "primary",
        allow_dismiss: true,
        newest_on_top: true,
        mouse_over: true,
        showProgressbar: false,
        spacing: 10,
        timer: 2000,
        placement: {
            from: "top",
            align: "right",
        },
        offset: {
            x: 30,
            y: 30,
        },
        delay: 1000,
        z_index: 10000,
        animate: {
            enter: "animate__animated animate__bounce",
            exit: "animate__animated animate__flash",
        },
    });

    const notificationTitle = "Data Message Title";
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
