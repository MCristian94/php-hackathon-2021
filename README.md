# PHP Hackathon
This document has the purpose of summarizing the main functionalities your application managed to achieve from a technical perspective. Feel free to extend this template to meet your needs and also choose any approach you want for documenting your solution.

## Problem statement
*Congratulations, you have been chosen to handle the new client that has just signed up with us.  You are part of the software engineering team that has to build a solution for the new client’s business.
Now let’s see what this business is about: the client’s idea is to build a health center platform (the building is already there) that allows the booking of sport programmes (pilates, kangoo jumps), from here referred to simply as programmes. The main difference from her competitors is that she wants to make them accessible through other applications that already have a user base, such as maybe Facebook, Strava, Suunto or any custom application that wants to encourage their users to practice sport. This means they need to be able to integrate our client’s product into their own.
The team has decided that the best solution would be a REST API that could be integrated by those other platforms and that the application does not need a dedicated frontend (no html, css, yeeey!). After an initial discussion with the client, you know that the main responsibility of the API is to allow users to register to an existing programme and allow admins to create and delete programmes.
When creating programmes, admins need to provide a time interval (starting date and time and ending date and time), a maximum number of allowed participants (users that have registered to the programme) and a room in which the programme will take place.
Programmes need to be assigned a room within the health center. Each room can facilitate one or more programme types. The list of rooms and programme types can be fixed, with no possibility to add rooms or new types in the system. The api does not need to support CRUD operations on them.
All the programmes in the health center need to fully fit inside the daily schedule. This means that the same room cannot be used at the same time for separate programmes (a.k.a two programmes cannot use the same room at the same time). Also the same user cannot register to more than one programme in the same time interval (if kangoo jumps takes place from 10 to 12, she cannot participate in pilates from 11 to 13) even if the programmes are in different rooms. You also need to make sure that a user does not register to programmes that exceed the number of allowed maximum users.
Authentication is not an issue. It’s not required for users, as they can be registered into the system only with the (valid!) CNP. A list of admins can be hardcoded in the system and each can have a random string token that they would need to send as a request header in order for the application to know that specific request was made by an admin and the api was not abused by a bad actor. (for the purpose of this exercise, we won’t focus on security, but be aware this is a bad solution, do not try in production!)
You have estimated it takes 4 weeks to build this solution. You have 2 days. Good luck!*

## Technical documentation
### Data and Domain model
In this section, please describe the main entities you managed to identify, the relationships between them and how you mapped them in the database.
### Application architecture
In this section, please provide a brief overview of the design of your application and highlight the main components and the interaction between them.
###  Implementation
##### Functionalities
For each of the following functionalities, please tick the box if you implemented it and describe its input and output in your application:

[x] Brew coffee \
[x] Drink coffee \
[x] Create programme 
- administratorul are puterea de a ceea, sterge si edita programele facute
   - insert
     - are nevoie de nume, timpul de inceput / sfarsit si id-ul camerei in care activitatea se desfasoara
   - update
     - la fel ca la insert doar ca are nevoie de id
     - output similar
   - delete
      - sterge activitatea in functie de id

[x] Create Room 
- administratorul are puterea de a ceea sterge si edita camerele facute
   - insert
     - introduce nr. camerei si nr. de locuri disponibile
   - update
     - la fel ca insert doar ca are nevoie de id-ul camerei existente
   - delete
      - sterge camera in functie de id 
   
[x] User Booking
- creeatea prograamarilor pe aza de cnp  
  - insert
    - introduce data timpul de inceput / final CNP-ul id-ul programului si al camerei (id-urile are trebui sa se faca utomat in spatele unui select)
  - update
      - la fel ca insert doar ca are nevoie de id-ul camerei existente
   - delete
      - sterge programarea in functie de id
  
[ ] Adding more admins 
- nu a fost implemntata dar urmeaza in cele 2 saptamani, pana primim un raspuns, sa fie adaugata
[ ] Book a programme
  
[x] Data output
- output-ul e format din succsess care indica daca actiunea a fost executata cu succes sau nu si mesajele de eroare in cazul in care datele introduse de admin sunt gresite incomplete sau nu respecta un anumit tipar
- este facut in asa fel incat sa respecte o structura acolo unde a fost posibil (e posibil sa fie peste tot aceeasi structura dar mai am de lucrat si timpul nu e suficient)

##### Business rules
Please highlight all the validations and mechanisms you identified as necessary in order to avoid inconsistent states and apply the business logic in your application.
 - Tot ce se afla in folderul Validators si in Hellpers este critic si ajuta la uniformizarea out-putului cat si la parametrizarea codului 
##### 3rd party libraries (if applicable)
Please give a brief review of the 3rd party libraries you used and how/ why you've integrated them into your project.
- Doar codul scris de mine pentru proiectele care le am inca active si in curs de terminare 
##### Environment
Please fill in the following table with the technologies you used in order to work at your application. Feel free to add more rows if you want us to know about anything else you used.
| Name | Choice |
| ------ | ------ |
| Operating system (OS) | Ubuntu 20.04.2 LTS |
| Database  | MySQL 10.3.25 |
| Web server| Nginx 1.18.0 |
| PHP |  7.4 |
| IDE | PhpStorm |

### Testing
In this section, please list the steps and/ or tools you've used in order to test the behaviour of your solution.
- lots of var_dumps() and a litle help from Postman
## Feedback
In this section, please let us know what is your opinion about this experience and how we can improve it:

1. Have you ever been involved in a similar experience? If so, how was this one different?
   - no
2. Do you think this type of selection process is suitable for you?
   - why not ? stress test... self evaluation... it can do a lot of damage but in the same time it can help improving your skills
3. What's your opinion about the complexity of the requirements?
   - whit each code line it become harder and harder :)))
4. What did you enjoy the most?
   - the moment whe you finally find the solution for a problem that almost make you give up
5. What was the most challenging part of this anti hackathon?
   - polishing the aplication :)))
6. Do you think the time limit was suitable for the requirements?
   - depends :)) but i want more time to be able to be proud of it
7. Did you find the resources you were sent on your email useful?
   - it was to shot the time to check them but ass far as i see there are some usefule information that i need to read after hackatlon (or september) ends
8. Is there anything you would like to improve to your current implementation?
   - evrithing
9. What would you change regarding this anti hackathon?
    - not sure for now
   - ca o nota extra :))) de unde am inceput sa renunt la engleza se reimte oboseala :))) nu ma crucificati pentru asta :)))
