## About this app

This application's backed is built on Laravel 5.4 and its frontend with Bootstrap 3.3.6 and VueJS 2.1.10.

See below the "Scenarios" and the "User experience" sections.

## Scenarios

### Backend Scenario

The company has decided to give a bonus coupon that can be redeemed for free deposit. However, to stop abuse we want to provide the bonus code only in exchange for an telephone number, sending the code in an SMS message.

Your task is to create a REST API endpoint that receives a phone number and sends an SMS.

The endpoint should be available at ‘/api/sms-promotion’. The request body will consist of a single field, “phone”. You should then send an SMS to the provided phone number, with one of two messages:

If the current server time is in the morning, the message should read “Good morning! Your promocode is AM123”.
If the current server time is in the afternoon or later, the message should read “Hello! Your promocode is PM456”.

The API should return a suitable HTTP response (you can get creative here), including handling errors appropriately.


### Frontend Scenario

Your task is to create a simple form for sending the above SMS code, collecting the phone number and passing it to the endpoint.
However, our legal team has insisted that before the form is submitted, we have two checkboxes which must be checked. - “I am over 18” and “I accept the terms and conditions”. There is no need for any styling.

## User experience

- The app uses HTML field validation and requires all fields to be filled
- If the user has already received the coupon once then it is not sent again
- If the user provides a wrong formatted number then the request is being rejected
- Session Flash messages are being provided after submitting the form with success or failure to enhance the user experience
- There are two message templates for this campaign and are chose based on the time of the request.
