<!--
    William Wyatt 10-3-15
    The index file. Currently just a debugging process.
-->
<html lang="English">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <link rel="stylesheet" href="styles/main.css">
        <script src="bower_components/webcomponentsjs/webcomponents-lite.js"></script>
        <link rel="import" href="bower_components/paper-tabs/paper-tabs.html">
        <link rel="import" href="bower_components/paper-tabs/paper-tab.html">
        <link rel="import" href="bower_components/iron-icon/iron-icon.html">
        <link rel="import" href="bower_components/iron-icons/iron-icons.html">

        <script src="scripts/main.js"></script>
        <link rel="import" href="objects/question-page.php">
    </head>
    <body>
        <!--
        * Sets up the menu & the question page
        * question page with index 1 is selected.
        -->
        <iron-pages id="pages" selected="1">
            <div></div>
            <question-page></question-page>
            <div></div>
       </iron-pages>
        <paper-tabs id='menu' class='menu' selected="1" align-bottom>
            <paper-tab onclick="document.querySelector('#pages').select(0)">Account&nbsp&nbsp<iron-icon class='menu-icon' icon="account-circle"></iron-icon></paper-tab>
            <paper-tab onclick="document.querySelector('#pages').select(1)">Questions&nbsp&nbsp<iron-icon class='menu-icon' icon="help"></iron-icon></paper-tab>
            <paper-tab onclick="document.querySelector('#pages').select(2)">Create&nbsp&nbsp<iron-icon class='menu-icon' icon="create"></iron-icon></paper-tab>
        </paper-tabs>
    </body>
    <footer>
    </footer>
</html>
