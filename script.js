function checkUnfollowers() {
    const form = document.getElementById('uploadForm');
    const formData = new FormData(form);
    const terminalOutput = document.getElementById('terminalOutput');
    terminalOutput.textContent = "[*] Starting unfollowers check...\n";
    fetch('process.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        const reader = response.body.getReader();
        const decoder = new TextDecoder('utf-8');
 
        function read() {
            reader.read().then(({ done, value }) => {
                if (done) {
                    terminalOutput.textContent += "[*] Process completed.\n";
                    return;
                }

                const decodedValue = decoder.decode(value);
                terminalOutput.innerHTML += decodedValue;
                terminalOutput.scrollTop = terminalOutput.scrollHeight; // Auto-scroll
                read();
            });
        }

        read();
    }).catch(error => {
        console.error("Error:", error);
        terminalOutput.textContent += "Error processing the files.\n";
    });
}