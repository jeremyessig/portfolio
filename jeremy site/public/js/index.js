/**
 * Calcule la position de la l'élément par rapport au haut de la page
 * @param {HTMLElement} element 
 * @return {number}
 */

function offsetTop(element, acc = 0){
    if(element.offsetParent){
        return offsetTop(element.offsetParent, acc + element.offsetTop);
    }

    return acc + element.offsetTop;
}

class Parallax{
    /**
     * 
     * @param {HTMLElement} element 
     */
    constructor(element){
        this.element = element;
        this.ratio= parseFloat(element.dataset.parallax);
        this.onScroll = this.onScroll.bind(this);
        this.onIntersection = this.onIntersection.bind(this);
        const observer = new IntersectionObserver(this.onIntersection);
        observer.observe(element);
        //document.addEventListener('scroll', this.onScroll);
        this.onScroll();
    }

    /**
     * @param{IntersectionObserverEntry[]} entries
     */
    onIntersection(entries){
        for(const entry of entries){
            if(entry.isIntersecting){
                document.addEventListener("scroll", this.onScroll);
            }else{
                document.removeEventListener("scroll", this.onScroll);
            }
        }
    }


    onScroll(){
        console.log(this.element.getAttribute('class'));
        const screenY = window.scrollY + window.innerHeight / 2;
        const elementY = offsetTop(this.element) + this.element.offsetHeight / 2;
        const diffY = elementY - screenY;
        this.element.style.setProperty('transform', `translateY(${diffY * -1 * this.ratio}px)`)
    }

    /**
     * 
     * @returns {Prallax[]}
     */
    static bind(){
        return Array.from(document.querySelectorAll('[data-parallax]')).map((element) =>{
            return new Parallax(element);
        })
    }
}

Parallax.bind();

