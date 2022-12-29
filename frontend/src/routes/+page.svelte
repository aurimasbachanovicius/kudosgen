<script>
    let from = '';
    let to = '';
    let message = '';
    let result = '';

    let imageUrl = 'testing';

    async function doPost() {
        const res = await fetch('http://127.0.0.1:8383', {
            method: 'POST',
            body: JSON.stringify({
                from,
                to,
                message
            }),
        });

        console.log(res);

        // if (res.ok) {
        //     console.log('OK');
        // } else {
        //     console.log('NOT OK');
        // }

        // console.log(res);
        // const imageBlob = await res.blob();
        // console.log(imageBlob);
        // let reader = new FileReader();
        // reader.readAsDataURL(imageBlob);
        // imageUrl = reader.result
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

<img src={imageUrl} alt=""/>