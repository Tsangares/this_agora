
<link rel="import" href="/bower_components/polymer/polymer.html">
<link rel="import" href="/bower_components/paper-button/paper-button.html">
<link rel="import" href="/bower_components/iron-collapse/iron-collapse.html">
<link rel="import" href="/bower_components/paper-input/paper-input.html">

<link rel="import" href="/objects/question-stream.php">

<dom-module id="question-page">
    <style>
        .newpost-button{
            padding: 2vmin;
            margin: 0;
            align-content: center;
            width: 100%;
            color: white;
            font-size: 4vmin;
            background-color: #4285F4;
            border: 1px solid #3275E4;
        }
        .newpost-content{
            display: flex !important;
            margin: 0;
            align-content: center;
        }

    </style>
    <template>
        <div class="post" >
            <!--
            * Creates the new question field and the question stream below.
            -->
            <paper-button class="newpost-button" onclick="newPostButtonPressed()"><p id="newpost-text">New Question</p></paper-button>
            <iron-collapse class="post-content newpost-content" id="newPost">
                <paper-input id="question" name="question" class="post-input" label="question"></paper-input>
                <paper-button onclick="submitQuestion()" class="submit">ASK</paper-button>
            </iron-collapse>
        </div>
        <question-stream></question-stream>
    </template>
    <script>
        Polymer({
           is: "question-page"
        });
    </script>
</dom-module>