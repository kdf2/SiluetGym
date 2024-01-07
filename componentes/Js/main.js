/*menu*/
const navMenu=document.getElementById('nav-menu'),
      navToggle=document.getElementById('nav-toggle'),
      navClose=document.getElementById('nav-close')

if(navToggle){
    navToggle.addEventListener('click', () =>{
        navMenu.classList.add('show-menu')
    })
}

if(navClose){
    navClose.addEventListener('click', ()=>{
        navMenu.classList.remove('show-menu')
    })
}

/*remover el menu para movil*/
const navLink=document.querySelectorAll('.nav__link')

const linkAction = () =>{
    const navMenu=document.getElementById('nav-menu')
    navMenu.classList.remove('show-menu')
}
navLink.forEach(m => m.addEventListener('click', linkAction)) 


/*logos*/

const scrollHeader = () =>{
    const header=document.getElementById('header')
    this.scrollY >= 50 ? header.classList.add('bg-header')
                       : header.classList.remove('bg-header')
}
window.addEventListener('scroll', scrollHeader)

/**/
const sections=document.querySelector('section[id]')
const scrollActive=()=>{
    const scrollY=window.pageXOffset
    sections.forEach(current =>{
        const sectionHeight=current.offsetHeight,
        sectionTop=current.offsetTop - 58,
        sectionId=current.getAttribute('id'),
        sectionsClass=document.querySelector('.nav__menu a[href*=' +sectionId + ']')
        if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
            sectionsClass.classList.add('active-link')
        }else{
            sectionsClass.classList.remove('active-link')
        }
    })
}

window.addEventListener('scroll', scrollActive)



/*boton*/

const scrollUp= ()=>{
    const scrollUp=document.getElementById('scroll-up')
    this.scrollY >= 350 ? scrollUp.classList.add('show-scroll') : scrollUp.classList.remove('show-scroll')
}
window.addEventListener('scroll',scrollUp)

/**/ 
const sr=ScrollReveal({
    origin:'top',
    distance:'60px',
    duration:2500,
    delay:400,
})

sr.reveal('.home__data, .footer__container, .footer__group')
sr.reveal('.home__img', {delay:700, origin: 'bottom'})
sr.reveal('.logos__img, .program__card, .pricing__card', {interval:100})
sr.reveal('.choose__img, .calculate__content', {origin:'left'})
sr.reveal('.choose__content, .calculate__img', {origin:'right'})
/*calculadora*/

const calculateForm=document.getElementById('calculate-form'),
    calculateCm=document.getElementById('calculate-cm'),
    calculateKg=document.getElementById('calculate-kg'),
    calculateMessage=document.getElementById('calculate-message')

const calculateBmi=(e) => {
    e.preventDefault()
    
    if(calculateCm.value === '' || calculateKg.value=== ''){
        calculateMessage.classList.remove('color-green')
        calculateMessage.classList.add('color-red')
        calculateMessage.textContent= 'complete la altura y peso'
        setTimeout(() =>{
            calculateMessage.textContent=''
        }, 3000)
    }else{
        const cm =calculateCm.value / 100,
              kg=calculateKg.value,
              bmi=Math.round(kg / (cm*cm))
        if(bmi<18.5){
            calculateMessage.classList.add('color-green')
            calculateMessage.textContent ='Tu indice de masa corporal es ' +bmi+ ' y estas delgado' 
        }else if(bmi<25){
            calculateMessage.classList.add('color-green')
            calculateMessage.textContent ='Tu indice de masa corporal es ' +bmi+ ' y estas saludable'
        }else{
            calculateMessage.classList.add('color-green')
            calculateMessage.textContent ='Tu indice de masa corporal es ' +bmi+ ' y tienes sobre peso'
        }
        calculateCm.value=''
        calculateKg.value=''
        setTimeout(() =>{
            calculateMessage.textContent=''
        }, 4000)
    }
}

calculateForm.addEventListener('submit', calculateBmi)


/*correo electronico*/
const contacForm=document.getElementById('contact-form'),
      contactMessage=document.getElementById('contact-message'),
      contactUser=document.getElementById('contact-user')

const sendEmail=(e) =>{
    e.preventDefault()

    if(contactUser.value === ''){
        contactMessage.classList.remove('color-green')
        contactMessage.classList.add('color-red')

        contactMessage.textContent='Debes ingresar tu correo electrónico'
        setTimeout(() =>{
            contactMessage.textContent=''
        }, 3000)
    }else{
        emailjs.sendForm('service_gl0edrf','template_301m2m4','#contact-form','Ubl52_VHugBMkGI-E')
            .then(() =>{
            contactMessage.classList.add('color-green')
            contactMessage.textContent='Te registraste existosamente'
            setTimeout(()=>{
                contactMessage.textContent=''
            },3000)
        }, (error) =>{
            alert('ALGO A FALLADO....', error)
        })
        contactUser.value=''
    }
}
contacForm.addEventListener('submit',sendEmail)
