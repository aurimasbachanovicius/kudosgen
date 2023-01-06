<script>
    import { onMount } from 'svelte';

    let imageData = '';

    onMount(async () => {



        let socket = new WebSocket('ws://127.0.0.1:8384');

        // When the socket is open, send a request for the image data
        socket.onopen = () => {
            socket.send('send_image');
        };

        // When data is received from the socket, decode it and store it in imageData
        socket.onmessage = (e) => {
            imageData = e.data;
        };
    });
    // Connect to the web socket



    let from = '';
    let to = '';
    let message = '';

    let imageUrl = '';

    async function doPost() {
        // const res = await fetch('https://kudosgen-nginx.fly.dev/api', {
        //     method: 'POST',
        //     body: JSON.stringify({
        //         from,
        //         to,
        //         message
        //     }),
        // });
        //
        // const imageBlob = await res.blob();
        // if (imageBlob instanceof Blob) {
        //     imageUrl = URL.createObjectURL(imageBlob);
        // }
    }
</script>

<form on:input={doPost}>
    <div class="grid">
        <label>
            From
            <input placeholder="From" bind:value={from}>
        </label>
        <label>
            To
            <input placeholder="To" bind:value={to}>
        </label>
    </div>

    <label for="message">Message</label>
    <textarea maxlength="102" id="message" placeholder="Message" bind:value={message}></textarea>
</form>

Image Data: {imageData}

<img alt="" src='data:image/png;base64,{btoa(imageData)}' />
<img width="100%;" src={imageUrl} alt=""/>