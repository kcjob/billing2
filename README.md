# billing2
Billing refactored
This is hopefully a more efficient version of version 1.
In the original version, I a CSV data file and store all the data in an array of arrays.
Next, I create an array of objects for each user. Following which I created and send an email user

In this version, I go straigt from reading the file, to creating an object for each user
Once the user object is complete, I create and send an email to the user.

How is this more efficient??
It uses less memory.  
In the first version, I store all the data in various arrays and objects before sending emails.
In the second version, I create the necessary arrays and object for a user, then send an email
to that user before the next user.


