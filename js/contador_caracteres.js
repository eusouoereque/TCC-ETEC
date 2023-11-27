const desc = document.querySelector("#detalhes");

console.log(desc);

desc.addEventListener("keypress", function(e){
    const inputLength = desc.value.length;
    const maxChars = 500;

    if(inputLength >= maxChars){
        e.preventDefault();
    }
})