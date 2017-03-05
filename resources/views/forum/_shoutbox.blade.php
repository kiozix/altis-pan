@if(Auth::user())

    <div class="row">
        <div class="panel-header">
            <h4>Shoutbox</h4>
        </div>
        <div class="panel-body" id="chat">
            <ul id="chatMessages">
                <li v-for="message in messages" class="message" :class="message.class">
                    <span class="who">@{{ message.who }}: </span>@{{ message.msg }}
                </li>
            </ul>

            <div style="display:table; width: 100%;">
                <input style="display:table-cell; width: 100%;" class="form-control" placeholder="Votre message..." type="text" v-model="newMessage" @keyup.enter="sendMessage">
            </div>
        </div>
    </div>
    <hr>
@endif