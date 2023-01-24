<script>
    import {onMount} from 'svelte';

    let form = {};

    let socket = '';
    let imageData = '';

    onMount(async () => {
        // some comment to trigger release.
        socket = new WebSocket('wss://kudosgen.com/ws');

        socket.onmessage = function (event) {
            imageData = event.data;
        };
    });

    async function doPost() {
        socket.send(JSON.stringify(form));
    }
</script>


<form on:input={doPost}>
    <div class="grid">
        <label>
            From
            <input placeholder="From" bind:value={form.from}>
        </label>
        <label>
            To
            <input placeholder="To" bind:value={form.to}>
        </label>
    </div>

    <label for="message">Message</label>
    <textarea maxlength="102" id="message" placeholder="Message" bind:value={form.message}></textarea>
</form>

<img alt="" src='data:image/png;base64,{imageData}'/>
