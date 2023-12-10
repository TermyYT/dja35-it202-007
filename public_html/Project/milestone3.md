<table><tr><td> <em>Assignment: </em> IT202 Milestone 3 API Project</td></tr>
<tr><td> <em>Student: </em> David Arthasseril (dja35)</td></tr>
<tr><td> <em>Generated: </em> 12/9/2023 10:09:24 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-3-api-project/grade/dja35" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone3 branch</li><li>Create a new markdown file called milestone3.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone3.md</li><li>Add/commit/push the changes to Milestone3</li><li>PR Milestone3 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes just to be up to date</li><li>Submit the direct link to this new milestone3.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> API Data Association </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Consider how your API data will be associated with a user</td></tr>
<tr><td> <em>Response:</em> <p>I have elected to create a &quot;Favorites&quot; list for the website users. The<br>goal was to allow Users to &quot;favorite&quot; any record in the Games table<br>and have it tied to their account. In my newly created relationship table,<br>UserFavorites, it tracks the user_id and game_id and ties them together in a<br>single record. Using the game_id, which is a foreign key to the id<br>in the Games table, we can acquire more info about the game. Using<br>the user_id, which is a foreign key to the id in the Users<br>table, we can acquire more info about the user. It&#39;s also ensured that<br>every combination of user_id and game_id is unique so that a user doesn&#39;t<br>favorite the same game multiple times.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Handling Data Changes</td></tr>
<tr><td> <em>Response:</em> <p>With the way I have my UserFavorites table set up, if the corresponding<br>data in the parent tables were to ever be updated or deleted, then<br>the relationship table would immediately update accordingly. That is what the &#39;CASCADE&#39; portion<br>of ON DELETE CASCADE and ON UPDATE CASCADE means. Therefore, this means that<br>the user would always see the most updated/newest version of the data.<br><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Handle the association of data to a user </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Which option did you need to do to handle the association of data?</td></tr>
<tr><td> <em>Response:</em> <p>In my case, I went with Option 1 and added a &quot;Favorite&quot; button<br>to my primary Game List page&#39;s table. That button would, similarly to the<br>Delete button, redirect to a temporary page called &quot;favorite_game.php&quot;, which would create the<br>association, and then return the user to the game list page. <br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add screenshots of the updated/created pages related to associating data with the user (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-09T22.44.541.PNG.webp?alt=media&token=08d48610-6feb-4140-b453-60dbb49e58ad"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the newly-added Favorite/Unfavorite button that associates game data to users.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T00.49.352.PNG.webp?alt=media&token=edd188cd-8b9a-4adf-aa9d-14c2fe659ce0"/></td></tr>
<tr><td> <em>Caption:</em> <p>A screenshot of game_browse.php with the appended Favorite button.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Include any Heroku prod links to pages that would trigger entity to user association</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/game_browse.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/game_browse.php</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_list.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/game_list.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/97">https://github.com/TermyYT/dja35-it202-007/pull/97</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Logged in user’s associated entities page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What is the data that's associated with the user?</td></tr>
<tr><td> <em>Response:</em> <p>In this case, records in the Games table are the entities that are<br>being associated with users. By favoriting, a user is associating themselves with the<br>game in my UserFavorites relationship table.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show screenshots of the logged in user's entities associated with them  (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T00.58.271.PNG.webp?alt=media&token=3d10c994-5505-4bd0-9857-ea6ee57375c3"/></td></tr>
<tr><td> <em>Caption:</em> <p>A screenshot of the logged in user&#39;s favorites page. The &quot;Unfavorite&quot; button will<br>unfavorite the game for the user, deleting the association.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.01.142.PNG.webp?alt=media&token=c5d7ebee-d526-4e25-9a00-46409a9af2ee"/></td></tr>
<tr><td> <em>Caption:</em> <p>Displays how many items are being shown while keeping the total count intact.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T02.44.353.PNG.webp?alt=media&token=df8b7d32-5cd9-431e-bd18-d7842770a411"/></td></tr>
<tr><td> <em>Caption:</em> <p>Server-side code for ensuring that the limit is within range or defaulted to<br>10.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.34.454.PNG.webp?alt=media&token=c8df2abc-25e3-42ec-9fe6-3b50b2212e3a"/></td></tr>
<tr><td> <em>Caption:</em> <p>The code for the Favorites page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.49.475.PNG.webp?alt=media&token=13b18ae8-4a12-4f17-9182-f369a92bb457"/></td></tr>
<tr><td> <em>Caption:</em> <p>This shows the function of the Favorite/Unfavorite button that&#39;s rendered in the table.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.55.006.PNG.webp?alt=media&token=b85cadd4-6005-4e3e-ac4f-09ccc96befc9"/></td></tr>
<tr><td> <em>Caption:</em> <p>The favorite_game.php temp file that&#39;s accessed when the Favorite/Unfavorite button is pressed.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) where the logged in user has their entities listed</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/user_favorites.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/user_favorites.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/99">https://github.com/TermyYT/dja35-it202-007/pull/99</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> All Users association page (Note: This will likely be an admin page and is not the same as the previous item) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Describe/Explain the purpose of this page from your project perspective</td></tr>
<tr><td> <em>Response:</em> <div>The All Users Association page should give admin users the ability to do<br>3 things:</div><div>1) See which users have which games favorited across the entire UserFavorites<br>table.</div><div>2) Unfavorite games on behalf of other users.</div><div>3) In conjunction with the "All<br>Unfavorited Games" page, it allows admins to gain a greater understanding of what<br>games the users have a tendency to favorite or keep track of. Especially<br>with the "TotalUsers" column count, an admin can easily see how popular a<br>game is (at least in terms of how often it's favorited on the<br>website).<br></div><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show screenshots of the entity data associated with many users (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.21.381.PNG.webp?alt=media&token=0fad2b43-c8bf-41f2-81dc-a39bd15ecdb8"/></td></tr>
<tr><td> <em>Caption:</em> <p>A screenshot showing the All Users Association page with no filters applied. This<br>is an admin page. The &quot;Unfavorite&quot; button, in this case, unfavorites games associated<br>with the user_id for that particular row in the table.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.23.382.PNG.webp?alt=media&token=5b0fc69d-6154-41d8-a87e-752f2e2c682f"/></td></tr>
<tr><td> <em>Caption:</em> <p>A screenshot showing the result of clicking on &quot;dja35&quot; in the left column<br>of the All Users Association table. dja35 has a user_id of 1.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.27.123.PNG.webp?alt=media&token=e331d0a0-c88e-43bc-9162-6444a0ec1d5f"/></td></tr>
<tr><td> <em>Caption:</em> <p>A screenshot showing the result of filtering by username &quot;dj&quot;. It filters the<br>results down using a partial match, so there&#39;s no need to have the<br>exact username. It filters out user &quot;ilove202&quot; because that username doesn&#39;t contain the<br>string &quot;dj&quot; in it. Only when the username has a non-empty search value<br>does the &quot;Unfavorite All&quot; button appear in the top left.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.29.404.PNG.webp?alt=media&token=113823bd-ed03-45dc-8818-46a43091bb7d"/></td></tr>
<tr><td> <em>Caption:</em> <p>Shows the result of limiting to 2 records per page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T02.50.525.PNG.webp?alt=media&token=9cfbc46c-7879-4415-90f8-bcc7a54128a0"/></td></tr>
<tr><td> <em>Caption:</em> <p>Server-side code for ensuring that the limit is within range or defaulted to<br>10. The code for record limiting is the same as the logged-in user&#39;s<br>Favorites page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.36.116.PNG.webp?alt=media&token=8f83468b-3dc3-4675-b946-3766c6a1de6e"/></td></tr>
<tr><td> <em>Caption:</em> <p>The code for the All Favorited Games page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.50.265.PNG.webp?alt=media&token=05e80e4b-f01d-4687-a6d3-7d49837bd2d6"/></td></tr>
<tr><td> <em>Caption:</em> <p>This shows the function of the Favorite/Unfavorite button that&#39;s rendered in the table<br>as well as how the username leads to the profile of the associated<br>user.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.54.446.PNG.webp?alt=media&token=0c70c68e-3d2f-458e-8111-03b66f9b16af"/></td></tr>
<tr><td> <em>Caption:</em> <p>The favorite_game.php temp file that&#39;s accessed when the Favorite/Unfavorite button is pressed.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) where entities associated to many users can be seen</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/all_favorites.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/all_favorites.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/101">https://github.com/TermyYT/dja35-it202-007/pull/101</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Create a page that shows data not associated with any user (Note: This will likely be an admin page and is not the same as the previous item) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Show screenshots of the page showing entities not associated with anyone (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T01.57.311.PNG.webp?alt=media&token=4a3cdf90-9e6d-418d-bdd2-ff45a8dfe9cb"/></td></tr>
<tr><td> <em>Caption:</em> <p>A screenshot showing the state of the All Unfavorited Games table. This is<br>an admin page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T02.08.043.PNG.webp?alt=media&token=79ef27e1-3554-4746-a290-a4b26223a306"/></td></tr>
<tr><td> <em>Caption:</em> <p>A screenshot showing the result of limiting records to 5 per page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T02.08.132.PNG.webp?alt=media&token=3414cfc9-dd2f-4a3f-a6e8-f639190da9f7"/></td></tr>
<tr><td> <em>Caption:</em> <p>Server-side code for ensuring that the limit is within range or defaulted to<br>10.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fdja35%2F2023-12-10T03.06.526.PNG.webp?alt=media&token=3ddff01d-08b1-465e-bd1c-5bc6384adc80"/></td></tr>
<tr><td> <em>Caption:</em> <p>The favorite_game.php temp file that&#39;s accessed when the Favorite/Unfavorite button is pressed. It<br>has code to update a boolean value in the Games table called &#39;isFavorite&#39;<br>that detects whether a game is favorited by any user or not. This<br>logic is the basis for the All Unfavorited Games list.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add Heroku Prod links to the page(s) where unassociated entities can be seen</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/unfavorited_games.php">https://it202-dja35-prod-3d176689ed49.herokuapp.com/Project/admin/unfavorited_games.php</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/TermyYT/dja35-it202-007/pull/100">https://github.com/TermyYT/dja35-it202-007/pull/100</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Admin can associate any entity with any users (Note: This may be a form on an existing association page if you rather not have a separate page for this) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing evidence of the checklist items (include code screenshots)</td></tr>
<tr><td><table><tr><td>Missing Image</td></tr>
<tr><td> <em>Caption:</em> (missing)</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explain the code logic for this page</td></tr>
<tr><td> <em>Response:</em> <div>[Unfinished]</div><div>Unfortunately, I was not able to work on this feature due to a<br>heavy time constraint; that being having group projects for other classes due within<br>the coming few days. In the interest of ensuring I did my part<br>for those projects, I had to leave out this feature for implementation at<br>a later time. However, had I possessed the extra time without other deadlines<br>to worry about, this feature would have been easily finished within the allotted<br>time period for Milestone 3.<br></div><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) related to this task</td></tr>
<tr><td>Not provided</td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Reflection </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Document any issues/struggles</td></tr>
<tr><td> <em>Response:</em> <div>The issues I had primarily revolved around debugging. At times, it felt like<br>I was trying to navigate a maze of errors filled with unexpected twists<br>and turns. I needed to ask for a lot of help, but at<br>the very least, I learned a lot from doing so; likely more so<br>than if I was to attempt everything purely by myself.<br></div><div><br></div><div>I also struggled with<br>dynamically reusing functions while remaining time-efficient. I had brought up the prospect with<br>the professor about simply making new files for existing functions that were given<br>minor changes. While this would've increased the file size of the project folder,<br>it was one approach to ensuring that I got exactly what I wanted<br>out of functions. However, my professor showed me methods for making existing functions<br>dynamic and flexible which helped a lot.</div><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Highlight any favorite topics</td></tr>
<tr><td> <em>Response:</em> <p>My favorite topic was Bootstrap and stylizing things for the website. When I<br>was introduced to Bootstrap in Milestone 2, I was excited to see how<br>different features could be implemented with modern website conventions in mind. I was<br>also pleased to see how universal, versatile, and robust the features were overall.<br>A bootstrap interface is a modern, sleek interface. I&#39;ll definitely try to implement<br>Bootstrap or other plug-and-use frameworks like this in future web development projects. It<br>made the styling significantly quicker, easier, and more in-line with the typical UI<br>one would expect from a modern website.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Overall how do you feel you did with the project and meeting requirements</td></tr>
<tr><td> <em>Response:</em> <div>While it was just enough time to complete each milestone, I genuinely wish<br>it was about 3 weeks per milestone instead of 2. With 2 weeks,<br>it basically ate up all my free time and I should consider myself<br>lucky that my other classes had either loose, distant, or lenient deadlines this<br>semester.<br></div><div><br></div><div>As for the website itself, while I do acknowledge that I am currently<br>missing one page as per Milestone 3, I couldn't possibly do it while<br>paying heed to my other projects, unfortunately. In general, though, I do believe<br>I have a solid foundation, and if I decide to flesh it out<br>even more, especially stylistically, I could even consider selling this website in the<br>future.<br></div><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Summarize your experience per the checklist items</td></tr>
<tr><td> <em>Response:</em> <div><b>Q: When you came into the class how much development experience had you<br>had?</b></div><div>A: In terms of web development, I had little experience. I had made<br>a very basic HTML website many years ago, but that was the extent<br>of it. It only used HTML and nothing else; not even CSS. This<br>website, however, is a massive step up and is my proof to myself<br>that I can create much more versatile websites.<br></div><div><br></div><div><b>Q: At this point, how do<br>you feel about your current experience now?</b></div><div>A: I feel much better. Of course,<br>there is a bit of "imposter syndrome" lingering in the back of my<br>mind because I was given a lot of starter code to work with<br>and I don't know how well I would be able to make a<br>website from the ground up in a short time frame, but at least<br>I was able to understand the pieces given to me and put them<br>together to create a website that ultimately met my end goal for the<br>project.<br></div><div><br></div><div><b>Q: Would there be anything you'd do differently?</b></div><div>A: I'd learn more debugging techniques<br>because where I struggled the most was debugging since it can be rather<br>ambiguous at times.<br></div><br></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-3-api-project/grade/dja35" target="_blank">Grading</a></td></tr></table>