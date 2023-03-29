# Laravel Code Challenge

## Overview

This exercise will have the candidate build CRUD functionality for a sample CRM. 

## Expectations

After following the instructions below, the final product should allow the user to index a contact list while also having the ability to create, update and delete a contact.

Please commit the code after clearing each point of this challenge by naming the commit with a significative name.

## Challenge

1. Create a database migration for a 'contacts' table with the following columns:
<ul>
    <li>first_name | required</li>
    <li>last_name | required</li>
    <li>phone | optional</li>
    <li>email | optional</li> 
</ul>

2. Create Model, Controller and the Routes for the CRUD project

3. Build a simple interface with VueJS and TailwindCSS to:
<ul>
    <li>list all the contacts</li>
    <li>add new contact</li>
    <li>edit an existing contact</li>
    <li>delete a contact from the list</li>
</ul>

4. [OPTIONAL] Utilize Laravel's form requests to validate the incoming form data. In the validation rules, make the first_name and last_name fields required. 

5. [OPTIONAL] Create a login system with 2 different roles (User|Admin). Grant permission to delete contacts only to Admin.

6. [OPTIONAL] Create an email notification to the Admin when a new contact is created

7. [OPTIONAL] Create a seeder to populate the contacts with 50 dummy contacts
