<?php include_once('../scripts/main.php'); ?>
<link rel="import" href="/bower_components/polymer/polymer.html">
<link rel="import" href="/bower_components/iron-list/iron-list.html">
<link rel="import" href="/bower_components/iron-collapse/iron-collapse.html">
<link rel="import" href="/bower_components/paper-button/paper-button.html">

<dom-module id="question-stream">
    <style>
        .avatar{
            width: 10vmin;
            height: 10vmin;
            background-color: #4FC3F7;
            border-radius: 50%;
        }
        .avatar-container{
            margin: 2vmin;
            width: 10vmin;
            vertical-align: middle;
        }
        .main-container{
            margin-left: 1.25%;
            width: 97.5%;
            align-content: center;
            overflow: hidden;
        }
        .question-container{
            position:relative !important;
            transform: none !important;
            background-color: #FFF;
            border: 1px solid #DDD;
            margin-top: 4vmin;
            border-radius: 8px;
        }
        .question-button{
            width: 100%;
            text-transform: initial !important;
            font-size: 8vmin;
            margin: 0;
        }
    </style>

    <template>
        <!--
        * Creates a list of all the questions.
        * It has a client-side php call to the function 'allQuestions'
        * which returns a json list in the format:
        * [{"id":"int","flag":"int","date":"2015-mm-dd hh:mm:ss","question":"string","creator":"int","responses":{"0":"string", "1":"string", ... "n":"string"}, ...]
        * If there are no responses the array in item.responses returns null.
        -->
        <iron-list id="questions-container" class="main-container" items='<?php echo allQuestions(); ?>' as='item' index-as="indx">
            <template>
                <!--
                * Questions are setup in a table:
                * |avatar|Question |
                * |blank |Responses|
                -->
                <table class="question-container">
                    <tr class="question-row">
                        <td class="avatar-container">
                            <div class="avatar"></div>
                        </td>
                        <td>
                            <!--
                            * This paper-button will set the id as 'questionPrefix-question_id'.
                            * questionPrefix is defined in the script tag.
                            * question_id is the datbase id for that question.
                            * This format is designed so one can find the question_id from the button's id.
                            * When clicked it will toggle and open the iron collapse in the following row.
                            -->
                            <paper-button id="{{getButtonName(item.id)}}" raised class='question-button' onclick="toggleResponse(this.id)">[[item.question]]</paper-button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <!--
                            * This iron-collapse will be set to id as 'responsePrefix-question_id'
                            * The content of this container is currently fucked up.
                            -->
                            <iron-collapse id="{{getContainerName(item.id)}}" name="unloadedResponse">{{getResponses(item)}}</iron-collapse>
                        </td>
                    </tr>
                </table>
            </template>
        </iron-list>
    </template>
    <script>
        //One spot to give the container & button their prefix.
        var responsePrefix = "response-container-";
        var questionPrefix = "question-";

        //Polymer constuctor thing.
        Polymer({
            //Setting this dom elemet tag.
            is: "question-stream"
            ,
            //Redundant function so getResponseContainerName & getQuestionButtonName
            //can be called as {{getContainerName(id)}} or {{getButtonName(id)}}
            //instead of using <script> tags.
            getContainerName: function(id) {
                return getResponseContainerName(id);
            },
            getButtonName: function(id){
                return getQuestionButtonName(id);
            },
            //Current method for designing how the responses should look.
            getResponses: function (item){
                var responses = item.responses;
                var container = document.createElement('div');

                if(responses != null) {
                    for(var i = 0; i < responses.length; ++i){
                        var response = responses[i];
                        container.appendChild(createResponse(response));
                    }
                }else{
                    container.appendChild(noResponses());
                }
                container.appendChild(newResponseButton());
                return container.innerHTML;
            }
        });

        //Sets up prefix-id
        function getResponseContainerName(id){
            return responsePrefix + id;
        }
        function getQuestionButtonName(id){
            return questionPrefix + id;
        }

        //Will toggle iron-collapse from paper-button
        function toggleResponse(name) {
            var id = name.replace(questionPrefix, '');
            document.querySelector("#" + getResponseContainerName(id)).toggle();
        }

        //Creates a response button
        function createResponse(response){
            var button = document.createElement('paper-button');

            return button;
        }

        //Creates a new response form/button
        function newResponseButton(){
            var button = document.createElement('paper-button');

            var icon = document.createElement('iron-icon');

            button.appendChild(icon);
            return button;
        }

        //Creates a display when there is no responses
        function noResponses(){
            var text = document.createElement('p');
            text.innerHTML = 'No response yet, make one!'
            return text;
        }
    </script>
</dom-module>