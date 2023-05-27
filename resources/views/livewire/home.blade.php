<div class="auth">
    <div class="auth_header">
        <div class="auth_header_title">
            <div>Haufe Authentificator</div>
        </div>
        <div class="auth_header_logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M22.83 26.342a7.835 7.835 0 0 1-9.498-2.61a7.276 7.276 0 0 1 .982-9.516a7.878 7.878 0 0 1 9.845-.736a7.308 7.308 0 0 1 2.479 9.257m-3.702 3.607l4.082 4.083h2.295v2.19h2.241v2.248l1.04 1.041H36v-3.278l-9.503-9.503"/><circle cx="17.498" cy="17.337" r="2.288" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/><circle cx="24" cy="24" r="21.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
    </div>

    <div class="auth_list">
        <div wire:poll.1000ms class="auth_list_no">
            Current time: {{ date("H:i:s", time()) }}
            {{-- <div>test: {{ date("s", time())  }}</div> --}}
        </div>
        @if(count($codes) > 0)
            @foreach ($codes as $code)
                <div class="auth_list_item" wire:poll.1000ms="timer">
                    <div class="auth_list_item_text">
                        <div class="auth_list_item_text_code" onclick="copy(this)">
                            <input type="text" value="{{$code->code}}" readonly  class="auth_list_item_text_code_input" >
                        </div>
                        <div class="auth_list_item_text_name">{{$code->name}}</div>
                    </div>
                    <div class="auth_list_item_timer">
                        <div>
                            @if($timer < 10)
                                <span style="color:brown;">00:0{{$timer}}</span>
                            @else
                                00:{{$timer}}
                            @endif
                        </div>
                        <svg class="auth_list_item_timer_delete" wire:click="toggleDeleteModal({{$code->id}})" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v10zM18 4h-2.5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1z"/></svg>

                        <svg class="auth_list_item_timer_delete" style="color: gray" wire:click="toggleModal({{$code->id}})" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>
                    </div>
                </div>
            @endforeach
        @else
            <div class="auth_list_no">No codes available 😢</div>
        @endif


    </div>

    <div class="auth_add" wire:click="toggleModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 112v288m144-144H112"/></svg>
    </div>

    @if($toggleDeleteModal)
        <div class="auth_module">
            <div class="auth_header" style="background-color: brown;">
                <div class="auth_header_title">
                    <div>Are you sure?</div>
                </div>
                <div class="auth_header_logo" wire:click="toggleDeleteModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 7l10 10M7 17L17 7"/></svg>
                </div>
            </div>

            <div class="auth_module_content auth_module_content_delete">
                <svg class="auth_module_content_alert" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M13 17.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm-.25-8.25a.75.75 0 0 0-1.5 0v4.5a.75.75 0 0 0 1.5 0v-4.5Z"/><path fill="currentColor" d="M9.836 3.244c.963-1.665 3.365-1.665 4.328 0l8.967 15.504c.963 1.667-.24 3.752-2.165 3.752H3.034c-1.926 0-3.128-2.085-2.165-3.752Zm3.03.751a1.002 1.002 0 0 0-1.732 0L2.168 19.499A1.002 1.002 0 0 0 3.034 21h17.932a1.002 1.002 0 0 0 .866-1.5L12.866 3.994Z"/></svg>
                <div class="auth_module_content_add_container">
                    <div class="auth_module_content_add" wire:click="deleteCode()" style="width: 100%; text-align:center; background-color: brown;">DELETE</div>
                </div>
            </div>
        </div>
        <div class="auth_layer"></div>
    @endif

    @if($toggleModal)
        <div class="auth_module">
            <div class="auth_header">
                <div class="auth_header_title">
                    @if($this->edit_id)
                        <div>Edit auth conn</div>
                    @else
                        <div>Add auth conn</div>
                    @endif
                </div>
                <div class="auth_header_logo" wire:click="toggleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 7l10 10M7 17L17 7"/></svg>
                </div>
            </div>

            <div class="auth_module_content">
                <input type="text" class="auth_module_content_input" placeholder="Add name" wire:model="code_name">

                <div class="auth_module_content_add_container">
                    <div class="auth_module_content_add" wire:click="addRandomName" style="margin-right: 1rem; background-color:lightgreen;">Create random name</div>
                    <div class="auth_module_content_add" wire:click="addCode">
                        @if($this->edit_id)
                            <div>Edit</div>
                        @else
                            <div>Add</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="auth_layer"></div>
    @endif


    <script>
        const auth_list_item_text_code_input = document.querySelectorAll('.auth_list_item_text_code_input');
        //copy on click

        for(let i = 0; i < auth_list_item_text_code_input.length; i++) {
            auth_list_item_text_code_input[i].addEventListener('click', function() {
                console.log("salit");
                this.select();
                document.execCommand('copy');
            })
        }

        function copy(e){
            e.children[0].select();
            document.execCommand('copy');
        }
    </script>
</div>