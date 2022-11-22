Basic Task Test

A laravel application that enables users to perform crud operations on task. The application is created with bootstrap framework and JQuery for the UI.
Below are the modules/functionalities:

1. User authentication system
    a. Registration
    b. Login
    c. Email Verification
    d. Password Reset
2. CRUD operations for task module

Mailtrap is used for the email verification and password reset.

New users must verify their email accounts before they can log in.

A one-many relationship is defined between the user and task model thus enabling task creator to be loaded along with the task details.
