@if(Auth::user())

    <div class="row">
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">ShoutBox</div>
                <div class="panel-body" id="chat">
                    <ul id="chatMessages">
                        <li v-for="message in messages" class="message" :class="message.class">
                            <span class="who">@{{ message.who }}: </span>@{{ message.msg }}
                        </li>
                    </ul>

                    <div style="display:table; width: 100%;">
						<span style="display:table-cell; width: 100px;">
							Votre message:
						</span>
                        <input style="display:table-cell; width: 100%;" type="text" v-model="newMessage" @keyup.enter="sendMessage"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif