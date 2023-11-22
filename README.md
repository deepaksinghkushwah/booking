## About Booking System

This booking system is build in Laravel9+MySQL. This system has following features...

General Features
----------------
1. Login/register (default role is Registered. Roles can be assigned from admin panel)
2. Confirm email on register users 
3. Backend panel for admin users
4. Users dashboard (Booking History)
5. Recaptcha V3 on login/registration


As Visitor
-----------
1. Book appointment from users list and available slots on particular date
2. Pay for booking slot
3. View orders history for booking


As Client (Booking Role)
------------------------
1. Setup their account on site like booking start/end time, booking dates, per slot price
2. Setup their availability
3. See all bookings related to them
4. Cancel Booking+Refund

Booking
----------
1. Show visitors booking list
2. Show clients booking list
3. Cancel booking from client end
4. Refund payment
5. Razorpay payment gateway integration


## Users/Roles/Permissions

This system have 3 main roles - 

1. Registered - Normal users role who can book appointment with clients
2. Booking - Client role who can setup slots and availability
3. Super Admin - Backend user who can manage other users