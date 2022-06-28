# War Of The Hello Worlds
War Of The Hello Worlds is a survey-ish service written in PHP that allows users with a [Replit](https://replit.com) account to sign in with it to vote and submit their own variations of the classic `Hello World`(not the program, the actual string).

A few variations includes
* Hello, World!
* hello world
* Hello world!
* Hello, World

While at first they all seen similar, they all are different from eachother. Variations of hello world can also include stuff like
* Hi World!
* Hi, Earth

While these are likely not the only examples that aren't just "Hello" and "World."

## Deploying
To deploy this, you'll need to create multiple files with some defualt values:
* `ADMINS.json` : set this to an array, and set the contents to the Replit usernames of all the people you want as an admin on your deploy
* `DENIED.json` : this should also be an array, this is used to store the strings that you would not like to allow to be submited in a request--please note that this doesn't account for variations of that string.
* `Requests.json` : set this to an array as well. This is used to store all requests, and their upvotes.
* `HelloWorlds.json` : set this to an object. This is used to store all aproved requests.

Feel free to update `rules.html` as you see fit.

Now that you've created and updated all files that you're going to be using, deploy this with PHP.