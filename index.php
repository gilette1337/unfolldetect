<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Unfollowers Detector</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Instagram Unfollowers Detector</h1>
        <hr>

        <div class="upload-section">
            <form id="uploadForm" enctype="multipart/form-data">

                <label for="followersFile">Upload your followers .json file (followers_1.json):</label>
                <input type="file" id="followersFile" name="followersFile" accept=".json" required><br><br>
                <label for="followingFile">Upload your followings .json file (following.json):</label>
                <input type="file" id="followingFile" name="followingFile" accept=".json" required><br><br>

                <button type="button" id="checkButton" onclick="checkUnfollowers()">Check</button>
            </form>
        </div>

        <hr>

        <div class="terminal">
            <pre id="terminalOutput">[ Terminal Output ]</pre>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>