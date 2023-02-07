# Comments

## 1. Routing logic

```
The principle of SOLID shows us that there is a function for each resource in the system we are developing, so I understand that the route file should only contain information about the calls, and informing who is responsible for answering that call, and what function which must be executed, when this route is accessed.
This issue was resolved by creating 2 controllers to resolve 2 different calls: 1 for calls coming from the API, and another for calls coming from web access.
The controller for calls coming from the API was created in the folder /app/Http/Controllers/API/GuestbookEntryController.php, and the other controller, to manage the calls coming from the web environment, was created in the folder /app/Http/Controllers/Web /GuestBookEntryController.php
I also changed the route and call names from /submit to /create, following the Laravel property convention (index, show, create, store, edit, update, destroy).
I grouped the routes that are part of the same controller, being necessary to declare only once, which controller this route responds to.
I added a prefix to the route through the ->name() function, to help identify the calls in the views right away, where this call will be forwarded, also avoiding duplication of paths, following the same convention as the route previously declared in the api .
Anticipating new deployments, I kept the prefix of the api route, in the web route, to help further separate the areas, functions and components that may be implemented in the future. In the route of creating a new entry in the guestbook, I added the prefix "/guestbook/create", this way we can have more control of the url.
In the auth-demo routes file it was asked not to touch these routes, so I didn't make any changes in this case. The same SOLID separation principle could be applied as well.
In this step, I didn't do any code refactoring, I just organized the issue of routes, as required by the exercise.

```

## 2. Completing the form

```
Created web route with post attribute to send the request to create a new entry.
Created a new store function in the /Web/GuestBookEntryController controller to receive the request and permanently save the data in the database.
Added route('guestbook.create') and method="POST" to form call assignments in form.blade.php file
Added "@csrf" form authenticity check field to avoid expired page errors: 419
Added title text field that wasn't showing.
Changed the user field names to the corresponding ones in the database.
Created a Request to validate the data coming from the form.
```

## 3. Separating the submitter information from the `GuestbookEntry`

```
Added Submitter Model.
Removed fillabel fields referring to the submitter from the GuestbookEntry model.
Created new migration to add new table "submitters" in database with field "email" being unique.
Created new migration to remove submitter fields from "guestbook_entries" table.
A note I would like to add here is that this step of the exercise was done to give dynamism to the exercise. The correct thing would be to carry out an implementation where all the current data in the "guestbook_entries" table were read, included in the "submitters" table, and this binding was made to the data that already exist in the database. That's why nullable(true) was placed in the migration of this table.
Added the ->with('submitter') tag to get calls from both the api controller and the web.
Changed "displayName" property to call the new structure's display_name.
When creating a new GuestbookEnry, it is checked if the email already exists as a Submitter, and creates a new one if it does not exist. If there is already a registered e-mail, associate it with this record.
Also changed the structure in the api controller.
```

## 4. Update an entry

```
I had previously understood that the User model would only be for access via api. As in this exercise it asks to link the authenticated user to the GuestbookEntry, so I removed the Submitter model, linked the User model, and made the changes in the migrations.
For that it was necessary to add a new composer package "doctrine/dbal" recommended by the framework.
Added route for update in routes/api.php file
Altar the api controller to include the new update() method
```

## 5. Generate an hourly report

```
I fixed the user->email tag on the index blade as it was still aspiring for submitter.
Job created to read all GuestbookEntries and put in a log different from laravel's default. This file will be in /storage/logs/guestbook.log
Created the instruction inside app/Console/Kernel.php so that the application is called every hour when running the command "artisan schedule:work"
```

## 6. React to an entry being deleted

```
A new event was created in the GuestbookEntryDeletionService file for the destroy() call.
Within this call, the procedure for deleting this record is carried out, and after deletion, the other necessary procedures are called.
In order not to increase the code here, I just made a logo informing that the procedure was accessed.
This Service was included in the controller in the call and this is how we managed to decouple the functions to follow the SOLID principle.
In this way, we can call the same attributes at different points in the application.
```

## Other changes

```
I made a change in the creation of a new GuestbookEntry, so that if the user does not exist, a new one is created. What happened before is that with the change from exercise 3, it is no longer possible to create a new user without the "password" field being filled in, and with this change, the password field has the default value of the example Seeder, being the value before the @ in the email. This way, even if the user is not registered, we can insert and register a new GuestbookEntry.
Another change in the index.blade.php bucket. If the "display_name" field is not filled in, the system will show the "real_name".
Custom middleware was included to protect the routes. As we are in an exercise, I only made it so as not to repeat the verification code in different places. When working with authentications, I use Sanctum's and Passport's native functions for route protection.
```