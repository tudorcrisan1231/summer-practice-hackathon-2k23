# summer-practice-hackathon-2k23

Wifi Name: HGGuest

Wifi Pass: haufegroup!

Developer: Crisan Tudor Nicolae

In this hackathon challenge, you will be tasked with developing a Multi-Factor Authentication (MFA) code generator. Don't worry it's not as scary as it sounds.

**Requirements:**

Develop a web application that runs locally in the browser

* A user can add a new MFA name-code pair, by providing a name for the code (if you ever wondered how to use a form tag, now’s the time to try!)
* A user can view all the available MFA name-code pairs
* A user can delete an existing MFA name-code pair.
* All MFA codes are regenerated once every 30 seconds (see window.setInterval())

Codes are made of 6 randomly generated digits. Bet you did this in college already.

**Bonus:**

* When the browser tab is closed and reopened, I want all my registered MFA name-code pairs to be preserved (see localStorage)

* The name of the new MFA name-code pairs is obtained via call to https://swapi.dev/api/people. Ever made an API call before? “fetch()”-ing information is simple once you get the hang of it.

Or, if you want to make it harder and more impressive:

* The name of the new MFA name-code pairs is obtained via call to the OpenAI API

* BYOF (bring your own feature) - go wild!

**Notes:**

Documentation and clean code will be highly appreciated.

Have fun!

Best of luck! Happy hacking!


**DOCUMENTATION:**

First action you can do in my application is to add a new MFA name-code pair or you can generate a random one (powerd by https://swapi.dev/api/people). You can do this by clicking on the "+" button. After you click on the button, a form will appear. You can fill the form with your own data or you can generate a random one. After you fill the form, you can click on the "Add" button to add the new MFA name-code pair. If you want to cancel the action, you can click on the "X" button.

The second action you can do in my application is to view all the available MFA name-code pairs along with the unique code for each one and the time left until they expire and are regenerated. You can delete/edit/copy codes for each item. If you want to delete an item, you can click on the "Delete" icon. If you want to edit an item, you can click on the "Edit" icon. If you want to copy the code for an item, you can click the code itself.

Every codes are regenerated once every 30 seconds and saved in a mysql database.