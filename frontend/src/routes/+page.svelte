<script>
    let from = '';
    let to = '';
    let message = '';

    let imageUrl = '';

    async function doPost() {
        const res = await fetch('https://kudosgen-nginx.fly.dev/', {
            method: 'POST',
            body: JSON.stringify({
                from,
                to,
                message
            }),
        });

        const imageBlob = await res.blob();
        if (imageBlob instanceof Blob) {
            imageUrl = URL.createObjectURL(imageBlob);
        }
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

<img width="100%;" src={imageUrl} alt=""/>