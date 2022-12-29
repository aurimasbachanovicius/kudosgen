<script>
    let from = '';
    let to = '';
    let message = '';
    let result = '';

    async function doPost() {
        console.log('does post');
        const res = await fetch('https://httpbin.org/post', {
            method: 'POST',
            body: JSON.stringify({
                from,
                to,
                message
            })
        })

        const json = await res.json()
        result = JSON.stringify(json)
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
    <textarea id="message" placeholder="Message" bind:value={message}></textarea>
</form>

{result}