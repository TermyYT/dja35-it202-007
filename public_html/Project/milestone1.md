<table><tr><td> <em>Assignment: </em> IT202 Milestone1 Deliverable</td></tr>
<tr><td> <em>Student: </em> David Arthasseril (dja35)</td></tr>
<tr><td> <em>Generated: </em> 11/11/2023 11:44:29 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone1-deliverable/grade/dja35" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone1 branch</li><li>Create a milestone1.md file in your Project folder</li><li>Git add/commit/push this empty file to Milestone1 (you'll need the link later)</li><li>Fill in the deliverable items<ol><li>For each feature, add a direct link (or links) to the expected file the implements the feature from Heroku Prod (I.e,&nbsp;<a href="https://mt85-prod.herokuapp.com/Project/register.php">https://mt85-prod.herokuapp.com/Project/register.php</a>)</li></ol></li><li>Ensure your images display correctly in the sample markdown at the bottom</li><ol><li>NOTE: You may want to try to capture as much checklist evidence in your screenshots as possible, you do not need individual screenshots and are recommended to combine things when possible. Also, some screenshots may be reused if applicable.</li></ol><li>Save the submission items</li><li>Copy/paste the markdown from the "Copy markdown to clipboard link" or via the download button</li><li>Paste the code into the milestone1.md file or overwrite the file</li><li>Git add/commit/push the md file to Milestone1</li><li>Double check the images load when viewing the markdown file (points will be lost for invalid/non-loading images)</li><li>Make a pull request from Milestone1 to dev and merge it (resolve any conflicts)<ol><li>Make sure everything looks ok on heroku dev</li></ol></li><li>Make a pull request from dev to prod (resolve any conflicts)<ol><li>Make sure everything looks ok on heroku prod</li></ol></li><li>Submit the direct link from github prod branch to the milestone1.md file (no other links will be accepted and will result in 0)</li></ol></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Feature: User will be able to register a new account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add one or more screenshots of the application showing the form and validation errors per the feature requirements</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T02.27.551.PNG.webp?alt=media&token=4b9c0b8e-6658-4097-a0a2-030d40113e47"/></td></tr>
<tr><td> <em>Caption:</em> <p>Showing the invalid email, password, and mismatched password validations.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T02.31.362.PNG.webp?alt=media&token=3e1c3fd3-de0c-4677-92e7-4f1087248def"/></td></tr>
<tr><td> <em>Caption:</em> <p>Showing unavailable email validation.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T02.32.113.PNG.webp?alt=media&token=43f4ec52-b96f-4aaf-abdd-ad5a213cf8c4"/></td></tr>
<tr><td> <em>Caption:</em> <p>Showing unavailable username validation.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T02.32.344.PNG.webp?alt=media&token=f0b21659-a066-44ea-908a-31f536251a03"/></td></tr>
<tr><td> <em>Caption:</em> <p>Form with valid data before submission.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of the Users table with data in it</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T02.34.145.PNG.webp?alt=media&token=d06087e7-ac1b-4172-8094-66b597b15664"/></td></tr>
<tr><td> <em>Caption:</em> <p>The new user data has been added to the database.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/18">https://github.com/TermyYT/dja35-it202-007/pull/18</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <div><b>Built-in: </b>Form, PHP Validation, Password Hashing, Database</div><div><b>Custom: </b>JS Validation<br></div><div><b><br></b></div><div><b>Form:</b> To receive form data,<br>we check if the POST magic variable is populated with data from the<br>user upon attempted submission. The code checks the POST variable to see if<br>it has data. Then, we use that data in the validation process. We<br>set the acquired data to variables containing safe echoed versions of said data.<br>We set each field to required to ensure that the field has content<br>upon submission. We give the username a maxlength of 30 and the password<br>a minlength of 8.<br></div><div><b>Validation:</b> Once we've created the variables with the corresponding data,<br>we check using functions from sanitizers.php to see if certain input is valid<br>or not and use a hasError check. We also check for any empty<br>inputs. This is for the backend PHP side. In the frontend JS side,<br>which is the part I custom made, we use the same logic but<br>using helpers.js functions instead. Here, I used the functions: sanitizeEmail(), isValidEmail(), isValidUsername(), and<br>isValidPassword(). I use these to check the input against the rules defined in<br>helpers.js and also check whether they're empty or not, and if they're all<br>valid, the checks pass and the form submits.<br></div><div><b>Password:</b> We take the $password value<br>and run it through a BCRYPT hashing algorithm. We then apply that to<br>the $hash variable which eventually gets placed in the database alongside the other<br>data. We never store plaintext passwords.<br></div><div><b>Database:</b> We get the database and assign it<br>to a variable. We prepare to put the data in and attach it<br>to a $stmt variable which is then "executed" to INSERT INTO the acquired<br>data into the database. <br></div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Feature: User will be able to login to their account </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add one or more screenshots of the application showing the form and validation errors per the feature requirements</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T04.01.561.PNG.webp?alt=media&token=fc954997-f5ac-467e-af43-472e71eb5645"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the password mismatch validation.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T04.05.552.PNG.webp?alt=media&token=255d8e4a-3c93-4be1-8209-54f117fe9f2d"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the non-existent user validation.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of successful login</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T04.07.013.PNG.webp?alt=media&token=9b0899a5-9ff8-4765-880c-131708a36e06"/></td></tr>
<tr><td> <em>Caption:</em> <p>What the user sees upon a successful login.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/19">https://github.com/TermyYT/dja35-it202-007/pull/19</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <div><div><b>Built-in: </b>Form, PHP Validation, Password Verification, Database</div><div><b>Custom: </b>JS Validation<br></div></div><div><b><br></b></div><div><b>Form:</b> To receive form data,<br>we again check if the POST magic <br>variable is populated with data from<br>the user. The code checks the POST <br>variable to see if it has<br>data. Then, we use that data in the validation<br> process. We set the<br>acquired data to variables containing safe echoed <br>versions of said data. We set<br>each field to required to ensure that the field has content upon <br>submission.<br>We give the password a <br>minlength of 8.</div><div><b>Validation:</b> Once we've <br>created the variables<br>with the corresponding data, we check using <br>functions from sanitizers.php to see if<br>certain input is valid or not <br>and use a hasError check. We also<br>check for any empty inputs. This is <br>for the backend PHP side. In<br>the frontend JS side, which is the part I wrote, we use the<br>same logic<br> but using helpers.js functions instead. Here, I used the function: isValidPassword().<br>Since the login page allows for either username or email, I also check<br>to see if the username/email field is simply empty, and if it is,<br>the check doesn't pass. Otherwise, any input would work here. For the password,<br>I simply check that the password is not empty and not less than<br>8 characters (since 8 is the minimum).<br></div><div><b>Password:</b> We don't use a password_hash() this<br>time. Instead, we use password_verify() to compare it to the value present in<br>the DB by extracting the salt and comparing hashes. If it matches, the<br>entered password is correct.<br></div><div><b>Database:</b> We get the database <br>and attach it to a<br>variable. We prepare to put the data in and attach it<br> to a<br>$stmt variable which is then "executed" to SELECT the corresponding data from the<br>database which is then compared to the acquired data. If the information matches,<br>the user is logged in.<br></div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Feat: Users will be able to logout </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the successful logout message</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T18.05.481.PNG.webp?alt=media&token=86d6fef4-d336-4537-8c92-aad058dac7c6"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the message of the user being logged out.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing the logged out user can't access a login-protected page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T18.07.022.PNG.webp?alt=media&token=001becdf-7598-4c12-a2e8-9668293d18de"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what the user sees when attempting to access the profile page<br>when not logged in.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/19">https://github.com/TermyYT/dja35-it202-007/pull/19</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works</td></tr>
<tr><td> <em>Response:</em> <p>We use the magic $_SESSION variable to get session data. This tells PHP<br>to look for the PHPSESSID cookie, and if one isn&#39;t found, it&#39;s created<br>for the user. This contains the session id that will be used to<br>lookup the session on the server. Whoever has this cookie/session will be identified<br>as the account holder. Default session timeout is 24 minutes in PHP. However,<br>the session is destroyed when the app is restarted or goes to sleep<br>on Heroku. In terms of the login, we set our session data by<br>taking data from the db, namely the username. This is how we associate<br>users with sessions. We even have a message that pops up (after redirecting<br>to home.php) that identifies the user upon login and welcomes them. For logout,<br>we&#39;ll start the session (session_start(); to get the current session), unset the variables,<br>and then destroy the session (reset_session()). Then, we redirect the user back to<br>the login page.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Feature: Basic Security Rules Implemented / Basic Roles Implemented </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing the logged out user can't access a login-protected page (may be the same as similar request)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T20.10.252.PNG.webp?alt=media&token=6574f353-cdeb-47a1-8342-079311a1bf12"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what the user sees when attempting to access the profile page<br>(login-protected) when not logged in.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing a user without an appropriate role can't access the role-protected page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T20.13.591.PNG.webp?alt=media&token=b901e526-a73f-4717-8cac-47f05162a6b6"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what the user sees when attempting to access the role creation<br>page (role-protected) when not having the appropriate role.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the Roles table with valid data</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T20.20.252.PNG.webp?alt=media&token=16d4849a-0096-4b0d-80bb-6461cbacdd33"/></td></tr>
<tr><td> <em>Caption:</em> <p>A screenshot of the Roles table in my database with an Admin role.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a screenshot of the UserRoles table with valid data</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-11T20.20.583.PNG.webp?alt=media&token=aa170ccb-2e62-4e4a-a91d-7c908d8184b3"/></td></tr>
<tr><td> <em>Caption:</em> <p>My user_id is 1 which corresponds to <a href="mailto:&#x64;&#x6a;&#97;&#51;&#53;&#64;&#116;&#101;&#x73;&#x74;&#x2e;&#99;&#111;&#109;">&#x64;&#x6a;&#97;&#51;&#53;&#64;&#116;&#101;&#x73;&#x74;&#x2e;&#99;&#111;&#109;</a> in the Users table. The<br>role_id is -1 which corresponds to Admin in the Roles table.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add the related pull request(s) for these features</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/43">https://github.com/TermyYT/dja35-it202-007/pull/43</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/38">https://github.com/TermyYT/dja35-it202-007/pull/38</a> </td></tr>
<tr><td> <em>Sub-Task 6: </em> Explain briefly how the process/code works for login-protected pages</td></tr>
<tr><td> <em>Response:</em> <div>For login-protected pages, the code first checks if the user is logged in<br>using the is_logged_in() function defined in user_helpers.php and which is referred to in<br>nav.php. In order for the user to access the page, is_logged_in() must be<br>set to true. Otherwise, the user will be redirected to the login page<br>upon trying to access a login-protected page. Speaking of nav.php, when is_logged_in() is<br>true, Home, Profile, and Logout are visible. When is_logged_in() is false, Login and<br>Register are visible. As for login.php, if the password is verified, it checks<br>the session data and sets the corresponding data from the database. <br></div><div><br></div><div>As for<br>sessions, in user_helpers.php, it checks if there's a user key in the session<br>and if there is, it assumes the user is logged in. If not,<br>it sets it to false. If the user is not logged in and<br>redirect is set to true, then it tells the user that they need<br>to be logged in and redirects them to login.php.<br></div><br></td></tr>
<tr><td> <em>Sub-Task 7: </em> Explain briefly how the process/code works for role-protected pages</td></tr>
<tr><td> <em>Response:</em> <div>For role-protected pages, the code uses the has_role() function instead which is also<br>defined in user_helpers.php and referred to in nav.php. In the first part of<br>the if statement, it checks if the user is <br>logged in using the<br>is_logged_in() function defined in user_helpers.php. It then checks if there is role data<br>in the session attached to the user. The if statement acquires the user's<br>role data from the database and checks if it matches up with the<br>present role data using a foreach loop. If it does, has_role() returns true.<br>If no such role data exists, then it returns false and flashes a<br>warning to the user, letting them know they can't access the page. In<br>nav.php, we define which pages a user sees depending on which role they<br>have. In our case, since we have the Admin role, anyone with the<br>Admin role is able to see create_role.php, list_roles.php, assign_roles.php. In order for the<br>user to access the<br> page, has_role() must be set to true. We can<br>use nav.php to further define what pages certain roles can see.<br></div><div><br></div>As for sessions,<br>in <br>user_helpers.php, it checks if there's a user key in the session and<br>if <br>there is, it checks the roles it has compared to what's in<br>the database. <br><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Feature: Site should have basic styles/theme applied; everything should be styled </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots to show examples of your site's styles/theme</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T00.14.201.PNG.webp?alt=media&token=619b8c71-697f-492a-9bd9-a862665e00fa"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot showcases a styled navigation menu (the tab lights up when hovered<br>over), forms having a slightly curved border radius and padding for a cleaner<br>overall look, and data being grouped into cleaner looking tables instead of being<br>placed next to each other visually.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/38">https://github.com/TermyYT/dja35-it202-007/pull/38</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain your CSS at a high level</td></tr>
<tr><td> <em>Response:</em> <div><b>Nav:</b> For the navigation bar, I created boxes for each of the navigation<br>items and some padding to separate them. I use "text-decoration: none" to remove<br>the underline for the text, "display: inline" to display everything horizontally, and I<br>made the text color black for easy readability.<br></div><div><b>Forms:</b> For this, I only altered<br>the input for now to have slightly-curved borders for the fields and some<br>extra padding to make it look cleaner.<br></div><div><b>Tables:</b> Here, I made edits to table,<br>th, and td. For the table, I made its width only 25% of<br>the width of the page, I set the border style to "collapse," and<br>added a 5 pixel margin to the top and bottom. For the border<br>color, I made it 1 pixel wide and white. For the header and<br>data field, I aligned the text to the center and added some padding<br>for visual clarity. Then, I made th and td have alternating colors for<br>background and text to clearly separate the header and body of the table.<br></div><div><b>Body:</b><br>I gave the background color a purple tint and kept the text color<br>as black for simplicity.<br></div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Feature: Any output messages/errors should be "user friendly" </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of some examples of errors/messages</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T00.52.031.PNG.webp?alt=media&token=b9ef6938-6957-4404-bb11-93f53c4c52a5"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot from Deliverable 1 showcases three different error messages displayed to the<br>user. The first is for an invalid email address format, the second is<br>when the password length is less than 8 characters long, and the third<br>is when the passwords don&#39;t match.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a related pull request</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/28">https://github.com/TermyYT/dja35-it202-007/pull/28</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/38">https://github.com/TermyYT/dja35-it202-007/pull/38</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain how you made messages user friendly</td></tr>
<tr><td> <em>Response:</em> <div>For displaying user friendly messages, we use flash.php in conjunction with flash_messages.php to<br>create div containers for our messages and display them to the user. It<br>checks if we have messages and places them right below nav on the<br>web page. We call flash() whenever we wish to display a message to<br>the user. It takes a string argument to display and one of four<br>colors which is dictated by the following keywords: info, success, danger, warning. Anywhere<br>there was previously an echo statement has now been replaced with a flash<br>message. Also, at the bottom of each page that utilizes these flash messages,<br>the flash.php file is required.</div><div><br></div><div>With the addition of the Housekeeping branch, we've also<br>added the Javascript version of flash messages in helpers.js. <br></div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Feature: Users will be able to see their profile </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of the User Profile page</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T01.35.201.PNG.webp?alt=media&token=6cab96df-e2a2-4948-8297-c672c05bc679"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the email and username fields being prefilled with data.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/34">https://github.com/TermyYT/dja35-it202-007/pull/34</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Explain briefly how the process/code works (view only)</td></tr>
<tr><td> <em>Response:</em> <p>In profile.php, using the get_user_email() and get_username() functions which are defined in user_helpers.php,<br>we acquire the user&#39;s (detected by session) username and email. Then, we assign<br>it to variables in profile.php. From there, we provide the safer echoed versions<br>of each variable in the profile.php form and pass it in for the<br>value attribute. That way, the information is prefilled on the form.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Feature: User will be able to edit their profile </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots of the User Profile page validation messages and success messages</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T01.54.341.PNG.webp?alt=media&token=720b25e4-8f18-41f9-81c6-a35bc8e51946"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when the chosen username is unavailable.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T02.02.382.PNG.webp?alt=media&token=ce92ffcc-9dee-494d-8f54-2339357528d3"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when the chosen email is unavailable.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T02.28.573.PNG.webp?alt=media&token=eb0cd1b9-286f-4983-b7ce-094f8dff5995"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when the entered password fails the  isValidPassword()<br>JavaScript check.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T02.33.224.PNG.webp?alt=media&token=646d8121-9128-4050-96de-0520269cdc05"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when the entered email fails the isValidEmail() validation<br>check.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T02.34.025.PNG.webp?alt=media&token=e6f3fe47-3e1f-4ccc-922e-5dfbc3ea800c"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when the entered username fails the isValidUsername() validation<br>check.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T02.35.336.PNG.webp?alt=media&token=75119b50-7b67-46c2-8d04-d55ce443e9ae"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when the New Password and Confirm Password don&#39;t<br>match.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add before and after screenshots of the Users table when a user edits their profile</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T02.41.427.PNG.webp?alt=media&token=e82d7b77-bb9f-468a-aa22-b1ca43588224"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the screenshot taken BEFORE changing the username to ilove203.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T02.42.218.PNG.webp?alt=media&token=4f5dfe23-b5de-49a5-9520-2f3c0cc1e7f6"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the screenshot taken AFTER changing the username to ilove203.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the related pull request(s) for this feature</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/34">https://github.com/TermyYT/dja35-it202-007/pull/34</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Explain briefly how the process/code works (edit only)</td></tr>
<tr><td> <em>Response:</em> <div>The process takes place in profile.pfp.&nbsp;</div><div><br></div><div>Firstly, the JavaScript validation will run according to<br>the functions presented in helpers.js. The functions we use are isValidEmail(), isValidUsername(), isValidPassword().<br>We also ensure that the email, username, and password fields are populated with<br>data upon submission lest it fail (aka it cannot be empty). Using the<br>JavaScript validation, we're first able to check if the data passes all these<br>checks (ensuring proper formatting) before being passed along to PHP validation. There, similar<br>validation checks occur. If all checks are passed, then the DB is accessed<br>by searching for a user id using get_user_id() and updating the entry in<br>the Users table according to the corresponding safe echoed data. <br></div><div><br></div><div>When it comes<br>to checking the password and preparing to change it to a new one,<br>the safe echoed versions of all three types of passwords are saved into<br>variables. We do the empty and invalid formatting checks as usual. If there<br>are no failed checks, the current_password is correct, and new_password is equal to<br>confirm_password, then the password is updated with the new_password in the database. <br></div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 9: </em> Issues and Project Board </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing which issues are done/closed (project board) Incomplete Issues should not be closed</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T04.23.101.PNG.webp?alt=media&token=12802d59-2021-4bae-a1dd-3bcdf4773a22"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the first half of issues that are done for each milestone.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-12T04.23.152.PNG.webp?alt=media&token=60d90815-cd20-469f-9562-4395d66c6806"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the second half of issues that are done for each milestone.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Include a direct link to your Project Board</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/users/TermyYT/projects/1">https://github.com/users/TermyYT/projects/1</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Prod Application Link to Login Page</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/login.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/login.php</a> </td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone1-deliverable/grade/dja35" target="_blank">Grading</a></td></tr></table>