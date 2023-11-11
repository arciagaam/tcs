const sendButton = document.querySelector('#sendBtn');
const inputField = document.querySelector('#inputField');
const noConversation = document.querySelector('#noConversation');
const messages = document.querySelector('#messages');

sendButton.addEventListener('click', async () => {

    const {sendurl, conversationid} = sendButton.dataset;

    if(!conversationid && noConversation) {
        noConversation.remove();
    }
    
    if(inputField.value.length <= 0) {
        return;
    }

    if(messages) {
        appendNewMessage(inputField.value, 'user');
    }

    const form = new FormData();
    form.append('conversationId', conversationid);
    form.append('message', inputField.value);

    inputField.value = "";

    const sendMessage = await fetch(sendurl, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        method: 'POST',
        body: form,
    });

    if(sendMessage.ok) {
        const {message, senderUserId, conversationId} = await sendMessage.json();

        sendButton.dataset.conversationid = conversationId;

        if(!messages) {
            location.reload()
        }

        appendNewMessage(message, 'bot');
    }
    
});

function appendNewMessage(message, role = 'user') {
    const newMessage = Object.assign(document.createElement('p'), {
        className: `py-6 px-4 w-full even:bg-slate-100 ${role === 'user' ? 'text-right' : 'text-left'}`,
        innerText: message
    });

    messages.append(newMessage);
    newMessage.scrollIntoView();
}
