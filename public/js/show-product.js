document.addEventListener('DOMContentLoaded', () => {
    const botones = document.querySelectorAll('[aria-controls = disclosure-1]'),
        divs = document.querySelectorAll('.especificaciones'),
        imagPal = document.querySelector('#img-ppal'),
        imagenes = document.querySelectorAll('[img-role = img-slider]')

 actionText = ()=>{
      for(div of divs)
        div.classList.remove('mostrado')
}
    botones.forEach(  function(boton) {
            boton.addEventListener('click', function (boton, index)  {
            if(!this.parentElement.classList.contains('mostrado'))
                actionText()
            let spans = this.querySelectorAll('h3')
            let svgs = this.querySelectorAll('svg')
            spans.forEach(span => span.classList.toggle('text-indigo-600'))
            svgs.forEach(svg => svg.classList.toggle('hidden'))
            this.parentElement.classList.toggle('mostrado')
        })
    })

    function clickClassImg(img) {
        imagenes.forEach((imag) => {
            elem = imag.parentElement.previousElementSibling
            if (elem)
                elem.classList.add('ring-transparent')
            img.parentElement.previousElementSibling.classList.remove('ring-transparent')
            const srcTumb = img.src
            const srcPal = imagPal.src
            imagPal.src = srcTumb
            img.src = srcPal
        })
    }

    imagenes.forEach(img => {
        img.addEventListener('click', function () {
            clickClassImg(this)
        })
    })
})
