Project Name : Credit Transfer System (Using PHP)
Submitted by : MD. Shibbir Ahmed
	Delwer Hussan Pappu
	Amit kumar Sutradhar
	Farhana Tanjin Smriti
	Md. Imran Khan
	Shakib Ahmed

Batch Name : LICT-TUP-OFF-US-33
___________________________________
Project Setup:

Step 1: Create a new database named "db_credit_transfer" in phpmyadmin

Step 2: Set database username "root" and password ""

Step 3: Upload .sql file which included in zip file.

Step 4: Move "credit-transfer-system" folder in the root of htdocs.

Step 5: Run your php localhost server.

Step 6: Now open browser and visit "http://localhost/credit-transfer-system" or "http://127.0.0.1/credit-transfer-system"

Administrator Login Details : 
Username : admin
Password : admin

Normal User Login Details :
Username : shibbirgfn or amit or delwar
Password : 12345 or amit or delwar (respectively)

___________________________________________________
    
0.Template Design
    
	0.1 Bootstrap 3.7
    
	0.2 Jquery 3.2.1
    
	0.3 Used data table
    
	0.4 Used Font awesome


	
1.Registration
	
	1.1 Anyone can register
	
	1.2 Empty field validation
	
	1.3 Username Validation
	    
	1.3.1 unique username
	    
	1.3.2 username can contain a-z, 0-9, and '_'
	    
	1.3.3 username between 4 to 15 characters
    
	1.4 First name and last name validation
        
	1.4.1 First name and last name less then 15 characters
	
	1.5 Unique email address
	
	1.6 Password contains at least 4 characters
	
	1.7 After registration user account will be inactive and credit will be $0

	

2.Login
	
	2.1 Only admin and active id can login
	
	2.2 Empty field validation
	
	
	3.Admin User
	
	3.1 Can activate inactive account
	
	3.2 Can add credit to any account
	
	3.3 Can reduce credit to any account
	
	3.3 Can change active id to inactive
	
	3.4 Can delete any account
	
	3.5 Can edit any account's profile
	
	3.6 Can change any user's password
	
	3.6 Can change any user's username
	
	3.7 Can view any user's transferred history
	
	3.8 Can view any user's credit received history
	
	3.9 Can accept or refused user's credit request
	
	3.10 Can view all credit requests status

	

4.Active User
	
	4.1 Can transfer own credit to any active account
	
	4.2 Can view other active account's user info
	
	4.3 Can edit own profile
	
	4.4 Can change own password
	
	4.5 Can view only own transferred history
	
	4.6 Can view only own credit received history
	
	4.7 Can sent credit request to admin
	
	4.8 Can view credit request status

	5.Inactive User
	

5.1 Inactive user can not login (Need to active account by admin)


	

6.Dashboard
	
	6.1 Only logged user can view dashboard page otherwise visitor will be redirect root directory
