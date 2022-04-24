#GD TICKETING SYSTEM

## DESCRIPTION:
This is a GD Ticketing System application that mimics that basic functionality of a ticketing system. I created the application with a LAMP stack. I decided to use this stack due to famliarity and I believe it provides the necessary capabilities without all the unecessary bells and whistles. There is also Javascript incorporated in the project. For example, the sign up and log in form are validated on the client with JavaScript. For transparency, the main issue I faced while creating this application is ordering the MySQL queries for the home page to display the most recent message on refresh. 

## HOW TO INSTALL/RUN PROJECT:

To save those of you who will actually view this project the hassle, I built this application on my personal cPanel with the URL of "http://cams-productions.com/".

If you want to run the project locally, then you can do the following:

- Upload site's code to your root
- Create a MySql DB named 'gd_ticketing_db'
- Create a table named 'users' with the fields of 'id', 'username', 'password', 'role', and 'unique_id_val'
- Create a table named 'messages' with the fields of 'id', 'category', 'msg_content', 'unique_user_id', 'unique_ticket_id', 'last_edit_time', 'sender'
- Run the application by pathing to the root directory.


## HOW TO USE THE PROJECT:

By default, the landing page is a log-in page. If you already have an account, you can log in from there. If you do not have an account, you can use the link at the bottom to go to the Sign Up page. Once you're signed up, you'll be redirected to a welcome message, where you can opt to go to the dashboard. If you're already a user, you'll be routed directly to the dashboard. If the credential don't meet the requirements or if a username already exists, then red error messages will appear in the top right notifying you of such.

Depending on where you register your account determines your role. I.e., if you sign up behind a gogogo IP address then your role is set as analyst, otherwise your role is a customer.

Once in the dashboard, if you're an analyst:

- You can view all the current open tickets for every user and respond in the tickets.

- You have to option delete a ticket.

If you're a customer, you can only view tickets created by your account.

If the user is an analyst, they do not have the option to open a new ticket. However, customer accounts will have the option to create new tickets at the bottom of their dashboard.

Both analysts and customers can log out of their accounts, which will redirect back to the home page. The user's session is ended and they will have to sign back in to view any pages.


## CREDITS

Created by: Cameron R. Stephenson
Inspired by: Sucuri Team :)
