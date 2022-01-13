const target = document.getElementById('animated-text-target');
let array=["Bonjour,", "Hi,", "Hallo,", "Grüzi"];
let wordIndex = 0;
let letterIndex =0;

const createLetter = () =>{
    const letter = document.createElement('span');
    target.appendChild(letter);

    letter.textContent = array[wordIndex][letterIndex];

    setTimeout(()=>{
        letter.remove();
    }, 2800);

};

//-----------------------------------------------
// Fonction récursive
const loop = ()=>{
    setTimeout(()=>{
        if(wordIndex >= array.length){
            wordIndex = 0;
            letterIndex = 0;
            loop();
        }else if(letterIndex < array[wordIndex].length){
            createLetter();
            letterIndex++;
            loop();
        }else{
            wordIndex++;
            letterIndex = 0;
            setTimeout(()=> {
                loop();
            }, 2800);
        }
    }, 60);
};

loop()