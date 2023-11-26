<table><tr><td> <em>Assignment: </em> IT202 Milestone 2 API Project</td></tr>
<tr><td> <em>Student: </em> David Arthasseril (dja35)</td></tr>
<tr><td> <em>Generated: </em> 11/26/2023 6:45:30 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-2-api-project/grade/dja35" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone2 branch</li><li>Create a new markdown file called milestone2.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone2.md</li><li>Add/commit/push the changes to Milestone2</li><li>PR Milestone2 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 3</li><li>Submit the direct link to this new milestone2.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Define the appropriate table or tables for your API </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the table definition SQL files</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T19.46.411.PNG.webp?alt=media&token=4ff2f626-7e0d-45c3-bb7f-1b0cb16e1a16"/></td></tr>
<tr><td> <em>Caption:</em> <p>Table Name - Games<br>id - The auto-incremented primary key for each record.<br>api_id -<br>The game&#39;s unique api_id that is fetched anytime there&#39;s an API call. Not<br>present for user-created values.<br>title - The title of the game.<br>publisherName - The name<br>of the game&#39;s publisher.<br>description - The game&#39;s description.<br>releaseDate - The game&#39;s release date<br>on the Epic Store.<br>url - The game&#39;s URL.<br>originalPrice - The game&#39;s current price<br>(currentPrice) according to the API, but reworded to better fit the purpose of<br>the website.<br>discountPrice - The game&#39;s discounted price on the store.<br>currencyCode - The monetary<br>3-letter code (e.g. - USD).<br>created - The record&#39;s creation date and time.<br>modified -<br>The record&#39;s modification date and time.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Mappings</td></tr>
<tr><td> <em>Response:</em> <p><i>Format: <b>[API field name]</b> Database column name - Description of data field.</i><br>Table Name<br>- Games<br>id - The auto-incremented primary key for each record.<br><b>[id]</b> api_id - The<br>game&#39;s unique api_id that is fetched anytime there&#39;s an API call. Not present<br>for user-created values.<br><b>[title]</b> title - The title of the game.<br><b>[publisherName]</b> publisherName - The<br>name of the game&#39;s publisher.<br><b>[description]</b> description - The game&#39;s description.<br><b>[releaseDate]</b> releaseDate - The<br>game&#39;s release date on the Epic Store.<br><b>[url]</b> url - The game&#39;s URL.<br><b>[currentPrice]</b> originalPrice<br>- The game&#39;s current price according to the API, but reworded to better<br>fit the purpose of the website.<br><b>[discountPrice]</b> discountPrice - The game&#39;s discounted price on<br>the store.<br><b>[currencyCode]</b> currencyCode - The monetary 3-letter code (e.g. - USD).<br>created - The<br>record&#39;s creation date and time.<br>modified - The record&#39;s modification date and time.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/76">https://github.com/TermyYT/dja35-it202-007/pull/76</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Data Creation Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the Page and the Code (at least two)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T19.47.191.PNG.webp?alt=media&token=1ebdf7c7-9f20-45df-8f53-e85db23dd001"/></td></tr>
<tr><td> <em>Caption:</em> <ol>
<li>This is where a game entry is created. validate_game() performs backend validation.<br>save_data() calls the save_data.php file in the lib folder and saves the entry<br>as a record.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T19.47.262.PNG.webp?alt=media&token=b38ae56d-300f-4a9c-a2b5-0751a5588f94"/></td></tr>
<tr><td> <em>Caption:</em> <ol start="2">
<li>This is where the game is fetched from the database.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T19.47.343.PNG.webp?alt=media&token=b1d196e0-70c4-499b-a91b-73981ebce4fc"/></td></tr>
<tr><td> <em>Caption:</em> <ol start="3">
<li>This is the form itself. There is HTML validation in place on<br>this page.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T19.47.436.PNG.webp?alt=media&token=b2193677-a11f-4df2-a675-737ae1d3c1c6"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the backend PHP validation that takes place. Should the HTML validation<br>fail, this validation will take its place and flash messages if there are<br>any errors with form entry.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T03.15.414.PNG.webp?alt=media&token=ca654383-4828-4c0f-9a02-3e29123ecc0d"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is a photo of the create form with user-entered data prior to<br>submission. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T03.22.555.PNG.webp?alt=media&token=bba078ee-c543-4f10-a911-9041beade370"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is a photo of the successful game entry creation flash message.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Database Results</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T03.26.447.PNG.webp?alt=media&token=dc0734c2-0b8b-4a71-8b17-3254401e8b4e"/></td></tr>
<tr><td> <em>Caption:</em> <p>This image shows the latest user-created game entry and API-fetched game entry. When<br>the user creates a game entry, there is no associated api_id, and therefore,<br>that column is set to NULL. The opposite is the case when the<br>API fetches a game. This is how manual vs API is determined in<br>the database. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Misc Checklist</td></tr>
<tr><td> <em>Response:</em> <p><b>Q)</b> What makes your entities unique?<br><div><b>A)</b> Their api_id and their name. No two<br>games can have the same api_id, and in the event that there are<br>two user-created games, their names will set them apart because no two games<br>can have the same name either.</div><div><br></div><div><b>Q)</b> How are duplicates handled from manually-added items?</div><div><b>A)</b><br>This code doesn&#39;t explicitly check for duplicates for manually-added items, but any game<br>that contains the same title is automatically prevented from entering the database because<br>of the unique constraint.<br></div><div><br></div><div><b>Q)</b> How are duplicates handled from API added items?</div><div><b>A)</b> If<br>the id matches with one that&#39;s already in the database, then it&#39;ll call<br>the update_data() function and simply update the existing record with information instead of<br>making a new one. The same logic applies with the unique constraints as<br>mentioned previously.<br></div><div><br></div><div><b>Q)</b> Which role(s) have access to create entities?</div><div><b>A)</b> Both the user and<br>admin roles have access to entity creation permissions.<br></div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_profile.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_profile.php</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/78">https://github.com/TermyYT/dja35-it202-007/pull/78</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Data List Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot the list page and code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T19.58.141.png.webp?alt=media&token=10b12c60-45d6-4780-90f1-b63bdf4f938f"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page shows both manual and API-generated data together. The manual data is<br>the same one from the entry we made earlier. I have intentionally kept<br>out any field that indicates whether a record is API-made or user-made purely<br>for design purposes. This page also shows all the filtering and sorting options<br>we have presented. It also contains a field for specifying how many records<br>the user wants to be shown. The code for the record limit is<br>shown at the bottom. Each record has a View, Edit, and Delete button<br>on the right side. The Delete button is only visible to admin users.<br>The table is styled in a standard table format with the title of<br>the columns being represented as their standard English names instead of the basic<br>column names.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T05.59.262.PNG.webp?alt=media&token=c8bda421-0786-466f-b3e8-c144f7a5c020"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows a string match for &quot;Assassin&quot; and orders by descending discountPrice.<br>Of course, the discount prices match the originalPrice because these games aren&#39;t currently<br>on sale on Epic Games.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T05.51.103.PNG.webp?alt=media&token=9f07ce1b-b9a1-4286-bda7-e91d05d044fc"/></td></tr>
<tr><td> <em>Caption:</em> <p>This shows the result when there is no matching records. In this case,<br>random gibberish was entered in the title&#39;s search field and submitted.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <div><b>Q)</b> Consider which roles have access to this page and/or if a user<br>must be logged in to view this page</div><div><b>A)</b> There are two versions of<br>the game list page: game_list.php (for admins) and browse.php (for users). game_list.php has<br>all of the functionality including the delete function<br> and button. browse.php has all<br>of the functionality minus the delete <br>function and button. All users must be<br>logged in to view either of these pages, however.<br></div><div><br></div><div><b>Q)</b> Mention the roles/access for<br>the view, edit, and delete links of each entity.</div><div><b>A)</b> The admin can access<br>all of the functions, but the user can only view (single entities) and<br>edit (via the create/update page).</div><div><br></div><div><b>Q)</b> Explain what is actually being shown.</div><div><b>A)</b> In the<br>first screenshot, the latest newly created records are being shown. The top one<br>is manually created. The bottom one is created through the API data processing.<br>I have intentionally kept out any field that indicates whether a record is<br>API-made or user-made purely for design purposes. As for searching and filtering, I<br>perform a string match for "IT" in the title. I order the table<br>by id and have it in descending order. I limit the amount of<br>entries being shown to 2. <br></div><div><br></div><div><b>Q)</b> Talk about the filters/searching available on this<br>page.<br><b>A)</b> The title search allows users to find games with similar titles through<br>string matching, and the same logic is applied for the publisher name. The<br>release date search allows the user to select a date and see what<br>games were released on that day. The original price and discount price searches<br>allow the user to find games that match a particular cents count. The<br>columns filter allows ordering by a particular column and the order filter selects<br>what type of ordering scheme is to be followed. Finally, the record limit<br>allows the user to select how many records they'd like to limit the<br>table to upon initiating a search.<br></div><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_list.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_list.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/75">https://github.com/TermyYT/dja35-it202-007/pull/75</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/83">https://github.com/TermyYT/dja35-it202-007/pull/83</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/84">https://github.com/TermyYT/dja35-it202-007/pull/84</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> View Details Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T19.21.231.PNG.webp?alt=media&token=a618ddb9-ca9c-4250-b2fe-46066865a431"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot is the admin version of the single-view page that features extra<br>details and the addition of the Delete button.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T19.32.222.PNG.webp?alt=media&token=2429a2b8-8a22-4f46-9be0-a88171e5d109"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens when an invalid ID is passed as an<br>argument. It flashes a message indicating that the record could not be found.<br>In this case, I entered an id of &quot;99999&quot;.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>This is my admin version of the single-view page for individual game titles.<br>Unlike records in the list view, it also contains the publisher name, URL<br>link, and creation and modification dates. It also contains the Edit button (which<br>will take the user to the corresponding game profile page) and the Delete<br>button for deleting the record. The Edit button is available for both users<br>and admins, but they lead to either the user-version or admin-version of the<br>edit pages according to which version of the single-view page the user is<br>on. The Delete button is available only to admin users and will lead<br>the admin back to the admin list-view page. The foundation of the design<br>choice was a bootstrap card example found online and redesigned to fit my<br>needs. Finally, the page also contains a search bar so that the user<br>can directly head to the single-view page for a particular record.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_viewer.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_viewer.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/79">https://github.com/TermyYT/dja35-it202-007/pull/79</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/83">https://github.com/TermyYT/dja35-it202-007/pull/83</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Edit Data Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.06.121.PNG.webp?alt=media&token=32862101-74d2-4d21-8286-4a1af65e72b8"/></td></tr>
<tr><td> <em>Caption:</em> <p>This shows the Edit form. It is the same page as the Create<br>form, but the editing and updating is handled internally.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.09.232.png.webp?alt=media&token=d340e05b-ac3d-4022-a4c3-fde9899f3ee3"/></td></tr>
<tr><td> <em>Caption:</em> <p>This shows the message for a successful update, what was updated, and the<br>updated data automatically appearing in the form.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.10.341.PNG.webp?alt=media&token=71566592-10a0-42dc-b18e-abcbdc44194b"/></td></tr>
<tr><td> <em>Caption:</em> <ol>
<li>This is where a game entry is updated. validate_game() performs backend validation.<br>update_data() calls the update_data.php file in the lib folder and updates the record.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.11.302.PNG.webp?alt=media&token=b603e5df-7cff-4f2d-a7dc-69a573bf3b70"/></td></tr>
<tr><td> <em>Caption:</em> <ol start="2">
<li>This is where the game is fetched from the database.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.11.593.PNG.webp?alt=media&token=27f08958-478d-4090-9399-f1686e455184"/></td></tr>
<tr><td> <em>Caption:</em> <ol start="3">
<li>This is the form itself. There is HTML validation in place on<br>this page.<br></li>
</ol>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.12.276.PNG.webp?alt=media&token=34c5cf69-7f11-4fbc-a7f3-b4e077bf2164"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the backend PHP validation that takes place. Should the HTML validation<br>fail, this validation will take its place and flash messages if there are<br>any errors with form entry.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.15.553.PNG.webp?alt=media&token=7ddc097a-c287-41fd-ba6e-06714d08d919"/></td></tr>
<tr><td> <em>Caption:</em> <p>An invalid id leads back to the list page with a corresponding error<br>message.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_profile.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_profile.php</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/78">https://github.com/TermyYT/dja35-it202-007/pull/78</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Delete Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of related code/evidence</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.33.171.PNG.webp?alt=media&token=64fa273e-7c4b-414f-ad57-9c464c0fd778"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the ID being fetched through the query parameters, the invalid ID redirect<br>to the list page, checking if the user is an admin and allowed<br>to be on the page, shows the deletion query, and a redirect to<br>the list page where the record was likely deleted from.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.36.102.PNG.webp?alt=media&token=13d793e4-820f-4e57-9545-5f28734f002e"/></td></tr>
<tr><td> <em>Caption:</em> <p>Preparing to delete Assassin&#39;s Creed Valhalla from the database.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.36.383.PNG.webp?alt=media&token=0ad0a9df-c3ab-4f6f-a858-5d804b090807"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the flash message that appears when a record is deleted as well<br>as the search/filter fields being maintained after a delete.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T20.37.104.PNG.webp?alt=media&token=08f5d78c-de50-48df-a4a9-daba16935f84"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows Assassin&#39;s Creed Valhalla no longer appearing in the record table.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <div><b>Q)</b> Mention the roles/permissions for deleting an item.<br>Examples:<br>Can only delete entities they created,<br>can only be done by admin, or can only delete entities associated with<br>themselves.</div><div><b>A)</b> The way I have the delete function set up, only those with<br>the admin role are able to delete records. Regular users cannot delete records<br>from the database.</div><div><br></div><div><b>Q)</b> Describe the deletion process and whether it's a hard delete<br>or soft delete.</div><div><b>A)</b> The deletion process is a hard delete because it directly<br>deletes the record from the database. This ensures that the corresponding information no<br>longer exists in the database.</div><div><br></div><div><b>Q)</b> Explain how the sort/filter data from a list<br>page is carried back to the list page after a delete action.</div><div><b>A)</b> First,<br>the current URI is assigned to the previous session data variable. It is<br>used to store the URL of the page the user is on. Then,<br>it decides if the URL has "admin" in it, and if it does,<br>it will set the admin version of the game list to the URL<br>variable. Otherwise, it will use the user version of the game list. (NOTE:<br>Since regular users currently cannot delete records, the eventual redirect to browse.php may<br>seem pointless, but I've chosen to keep the logic for now in case<br>I decide to add a more intricate deletion system later.) Then, any parameters<br>acquired from get is appended to the URL. Finally, the redirect to the<br>assembled URL is executed and the user is returned.<br></div><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/80">https://github.com/TermyYT/dja35-it202-007/pull/80</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> API Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of Code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T21.33.031.PNG.webp?alt=media&token=fcbd047c-21de-4fef-bd37-844364d664e3"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the API data being initially fetched through the get() function using the<br>API URL. Then, it&#39;s processed in the process_games() function.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T21.34.262.PNG.webp?alt=media&token=746e653f-329c-4eb8-bdcf-ba296da1741a"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows how the API data fields are mapped to table columns. The releaseDate<br>requires special parsing and certain string fields need to go through HTML decoding<br>before being saved.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T21.36.563.PNG.webp?alt=media&token=71478757-8772-4948-af47-f7116470ecbc"/></td></tr>
<tr><td> <em>Caption:</em> <p>Referring to line 49, it appends &quot;ON DUPLICATE KEY UPDATE&quot; at the end<br>which ensures that if the key is considered a duplicate, it simply updates<br>the existing record instead of creating a new record.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p><b>Q)</b> Briefly overview the API to DB mapping (may be similar to a<br>previous task)<br><b>A)</b> The mapping of the API data is done in the process_single_game()<br>function where each field in the API&#39;s response is mapped to a column<br>in the database. Most of the columns in the database kept the same<br>names as the API fields except for api_id (which acquired the &#39;id&#39; field<br>from the API) and originalPrice (which acquired the &#39;currentPrice&#39; field from the API).<br>The releaseDate had to be parsed to fit the format of the DATE<br>type in the SQL database, and the string fields from the API had<br>to be decoded before being pushed into the database to avoid having encoded<br>characters being saved in the database. Then, the record was returned. This process<br>is repeated for every game acquired from the API.<br><br><b>Q)</b> Explain how the API<br>calls are triggered (they shouldn&#39;t be invoked too frequently)<br><div><b>A)</b> The API calls are<br>only triggered when the user types in a search query and submits the<br>search form. That&#39;s the purpose of the process_search() function.<br></div><div><br></div><div><b>Q)</b> Explain how you&#39;re using<br>the API data. What&#39;s your application&#39;s goal with it?</div><div><b>A) </b>I am using the<br>API data to populate a Games table in my database with various titles<br>from Epic Games including their corresponding information. Eventually, I&#39;ll have the user wish<br>list or save games of their choosing in a private list unique to<br>them.<br></div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/81">https://github.com/TermyYT/dja35-it202-007/pull/81</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What issues did you face and overcome during this milestone?</td></tr>
<tr><td> <em>Response:</em> <div>The main issue I faced was time. I wished we had 3 weeks<br>for each Milestone step instead of 2. I've been working for at least<br>8 hours, every day, for the past week on this project alone. I'm<br>lucky that my other classes don't have demanding deadlines at this moment.<br></div><div>I also<br>wish that the latter half of the Learn files were unlocked and available<br>since the start so we wouldn't have to wait until the last week<br>to have exposure to that content, especially since some of that content was<br>actually very relevant to and necessary for completing this Milestone's objectives. </div><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> What did you find the easiest?</td></tr>
<tr><td> <em>Response:</em> <p>I found the process of connecting all the different pages and pieces the<br>easiest and most fun. Being able to tie different pages together really made<br>it feel like an actual website and it was very exciting to see<br>my project slowly come to life. My eventual goal is to also update<br>the navbar so that it&#39;s more modernized and organized, and with the help<br>of bootstrap, that shouldn&#39;t be too hard of a task at all. Speaking<br>of, having bootstrap on hand really helped speed up the process for designing<br>things! I&#39;m so grateful it exists and I&#39;m impressed with its robustness and<br>versatility.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> What did you find the hardest?</td></tr>
<tr><td> <em>Response:</em> <p>The hardest part was making sure the API data was being formatted properly<br>upon entry into the database and upon being displayed. There are still some<br>minor changes I need to make here and there for displays, but I&#39;ll<br>save that for later. For now, all the core features work effectively.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Did you have to utilize any unanticipated APIs?</td></tr>
<tr><td> <em>Response:</em> <p>Fortunately, no. For the time being, this one API that I&#39;m using completely<br>suffices for my goals for this website.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a screenshot of your project board</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-11-26T22.59.511.PNG.webp?alt=media&token=3b96f6e3-c428-418f-a4aa-2f151c13d252"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the current state of the project board with all seven Milestone 2<br>objectives done and closed.<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-2-api-project/grade/dja35" target="_blank">Grading</a></td></tr></table>