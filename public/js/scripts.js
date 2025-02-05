

// HERE
document.addEventListener("livewire:navigated", () => {

  // Mobile Navigation
  const mobileNav = document.querySelector('.mobileNav')
  const hamburger = document.querySelector('#toggleNav')
  hamburger.addEventListener('click', toggleNav)

  function toggleNav() {
    const menuIcon = document.querySelector('.menuIcon')
    if (mobileNav.ariaExpanded == "true") {
      mobileNav.setAttribute("aria-expanded", "false")
      menuIcon.src = '/img/icons/menu-closed.svg'
      document.body.style = ''
    } else {
      mobileNav.setAttribute("aria-expanded", "true")
      menuIcon.src = '/img/icons/menu-open.svg'
      document.body.style = 'overflow-y: hidden;'

    }
  }

  const copyright = document.querySelectorAll('.copyright')
  const date = new Date()
  copyright.forEach((list) => {
    list.innerText = `Copyright ${date.getFullYear()} all rights reserved`
  })

  // Form aJax submit
  const form = document?.querySelector('#form');
  if (form) {
    form.addEventListener("submit", handleSubmit)
  }

  // Form loading
  const loading = document.querySelector('.loading')

  async function handleSubmit(e) {
    e.preventDefault()
    const url = '/api/contact'

    // Form has been submitted, so lets show the form is trying to send
    // Remove send message & plane, show spinner icon
    plane.style.visibility = 'hidden'
    loading.classList.toggle('hidden')

    try {
      const formData = new FormData(form)
      const responseData = await processSubmit({ url, formData })


      console.log(responseData)
      if (responseData) {

        // Form has been successful
        // Remove spinner, show plane
        plane.style.visibility = 'hidden'
        loading.classList.toggle('hidden')
        const message = document.querySelector('.formSuccess')
        message.classList.toggle('hidden')

        form.fullName.value = ''
        form.email.value = ''
        form.phone.value = ''
        form.comments.value = ''
        setTimeout(() => {
          message.classList.toggle('hidden')
        }, 4000);
      }

    }
    catch (error) {
      const message = document.querySelector('.formError')
      message.classList.toggle('hidden')
      plane.style.visibility = 'hidden'
      loading.classList.toggle('hidden')
      setTimeout(() => {
        message.classList.toggle('hidden')
      }, 4000);
      console.log(error)
    }

  }

  async function processSubmit({ url, formData }) {
    // convert form for ajax json
    const plainData = Object.fromEntries(formData.entries())
    const jsonData = JSON.stringify(plainData)
    const fetchOptions = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json"
      },
      body: jsonData
    }

    // send information
    const response = await fetch(url, fetchOptions)
    if (!response.ok) {
      const errorMessage = await response.text()
      throw new Error(errorMessage)
    }
    return response.json()
  }


  /*
    Image slider code
  */
  const slides = document?.querySelectorAll('.slide')
  // todo add next and previous buttons
  const next = document?.querySelector('#next')
  const prev = document?.querySelector('#prev')
  const auto = true;
  const intervalTime = 4500;
  let slideInterval;

  const nextSlide = () => {
    //get current slide
    const current = document?.querySelector('.current')
    // remove current class from slides
    current?.classList.remove('current')
    // Check next slide
    if (current?.nextElementSibling) {
      current.nextElementSibling.classList.add('current')
    } else {
      slides[0]?.classList.add('current')
    }
    setTimeout(() => current?.classList.remove('.current'), intervalTime)
  }

  const prevSlide = () => {
    //get current slide
    const current = document?.querySelector('.current')
    // remove current class from slides
    current?.classList.remove('current')
    // Check previous slide
    if (current?.previousElementSibling) {
      current?.previousElementSibling.classList.add('current')
    } else {
      // add current to last slide
      slides[slides.length - 1].classList.add('current')
    }
    setTimeout(() => current?.classList.remove('.current'))
  }

  //Button events for slider
  next?.addEventListener('click', e => {
    nextSlide()
  })
  prev?.addEventListener('click', e => {
    prevSlide()
  })

  // Auto Slide
  if (auto) {
    slideInterval = setInterval(nextSlide, intervalTime);
  }
  //



  // fadeIn Javascript

  const faders = document.querySelectorAll('.fadeIn')
  window.addEventListener('scroll', checkFade)
  const triggerBottom = window.innerHeight / 5 * 4


  function checkFade() {
    faders.forEach((fade) => {
      const boxTop = fade.getBoundingClientRect().top
      if (boxTop < triggerBottom) {
        fade.classList.add('show')
      }
    })
  }




  /*
    Call to Action code
  */
  const ctaButton = document?.getElementById('ctaSubmit')
  const plane = document?.getElementById('plane')

  ctaButton?.addEventListener('mouseover', () => {
    plane.style.transform = 'translateX(200%)'
    plane.style.opacity = '0'

    setTimeout(() => {
      plane.style.transform = 'translateX(0%)'
      plane.style.opacity = '1'

    }, 1500)
  })
  ctaButton?.addEventListener('mouseout', () => {
    if (plane.style.transform != 'translateX(0%)') {
      plane.style.transform = 'translateX(0%)'
      plane.style.opacity = '1'

    }
  })



  const craneThumb = document?.querySelectorAll('.craneThumb')
  const craneImg = document?.querySelector('.craneImg')

  craneThumb.forEach((img) => {
    img.addEventListener('click', () => {
      craneImg.attributes.src.value = img.attributes.src.value
    })
  })

  // craneImg.addEventListener('click', () => {
  //   lightBoxModal.classList.add('open')
  // })

  let imgI = 0
  const imgArray = Array.from(craneThumb)
  let back = imgArray.length
  let curImg = 1

  let imgTotal = document?.getElementById('imgTotal')
  let curImgNum = document?.getElementById('curImg')
  if (imgTotal) {
    imgTotal.innerText = back
  }
  if (curImgNum) {
    curImgNum.innerText = curImg
  }

  window.addEventListener('keydown', (e) => {
    // console.log(e.key)
    if (e.key === 'ArrowRight') {
      nextImage()
    }
    if (e.key === 'ArrowLeft') {
      prevImage()
    }
  })
  craneThumb.forEach((thumb) => {
    thumb.addEventListener('click', () => {
      const currentImg = document?.querySelector('.active')
      currentImg.classList.remove('active')
      thumb.classList.add('active')
      newThumb().scrollIntoViewIfNeeded()
      document.getElementById('slider').scrollLeft += (currentImg.width / 1.2)
    })
  })

  const prevCrane = document?.getElementById('prevCrane')
  const nextCrane = document?.getElementById('nextCrane')

  nextCrane?.addEventListener('click', nextImage)
  prevCrane?.addEventListener('click', prevImage)

  // Create keybindings to allow scrollings images
  function nextImage() {
    const currentImg = document?.querySelector('.active')
    currentImg.classList.remove('active')
    if (currentImg?.nextElementSibling) {
      craneImg.attributes.src.value = currentImg.nextElementSibling.attributes.src.value
      curImg++
      currentImg.nextElementSibling.classList.add('active')

    } else {
      curImg = 0
      craneImg.attributes.src.value = craneThumb[0].attributes.src.value
      craneThumb[0].classList.add('active')

    }

    return newThumb().scrollIntoViewIfNeeded()

  }

  function prevImage() {
    const currentImg = document?.querySelector('.active')
    currentImg.classList.remove('active')
    if (currentImg?.previousElementSibling) {
      curImg--
      craneImg.attributes.src.value = currentImg.previousElementSibling.attributes.src.value
      currentImg.previousElementSibling.classList.add('active')
    } else {
      curImg = craneThumb.length
      craneImg.attributes.src.value = craneThumb[craneThumb.length - 1].attributes.src.value
      craneThumb[craneThumb.length - 1].classList.add('active')
    }

    return newThumb().scrollIntoViewIfNeeded()

  }

  const newThumb = () => {
    const thumb = document?.querySelector('.active')
    if (curImg == 0) {
      curImg = 1
    }
    document.getElementById('curImg').innerText = curImg

    return thumb;
  }

  const lightBox = document?.getElementById('lightbox')
  const lightBoxModal = document?.getElementById('lightbox-modal')

  // lightBox.addEventListener('click', (e) => {
  //   // console.log(e.target.closest('.modalBox'))
  //   if (!e.target.closest('.modalBox')) {
  //     lightBoxModal.classList.remove('open')
  //   }
  // })



  // Filter Inventory
  const searchFilter = document?.querySelector('select[name="categories"]')
  searchFilter?.addEventListener('change', () => {
    filterInventoryBy(searchFilter.value)
  })

  function filterInventoryBy(category) {
    let removeFilter = document.querySelectorAll('div[data-category]')
    document.querySelectorAll('.fadeIn').forEach(fade => fade.classList.add('show'))
    if (category != "clear") {

      let filter = document.querySelectorAll('div[data-category]:not([data-category="' + category + '"])')
      let dataType = Array.from(filter)
      //clear previous filters first

      removeFilter.forEach(data => {
        if (data.classList.contains("hidden")) {
          data.classList.remove("hidden")
        }
      })
      dataType.forEach(data => {
        data.classList.toggle("hidden")
      })
    } else {
      removeFilter.forEach(data => {
        if (data.classList.contains("hidden")) {
          data.classList.remove("hidden")
        }
      })
    }


  }
  })
