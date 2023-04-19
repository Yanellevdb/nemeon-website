export const HeaderController = () => {
  // Reads out the scroll position and stores it in the data attribute
  // so we can use it in our stylesheets
  const storeScroll = () => {
    const html = document.querySelector('html')
    if (window.scrollY > 0) {
      html.classList.add('scroll')
    } else {
      html.classList.remove('scroll')
    }

    const scrollPosition = window.scrollY
    const windowHeight = document.body.scrollHeight
    const innerHeight = window.innerHeight
    const scrollHeight = windowHeight - innerHeight

    const scrollPercentage = (100 / scrollHeight) * (scrollPosition / 100) * 100

    const scrollBar = document.querySelector('.scrollbar')

    scrollBar.style.height = scrollPercentage
  }

  // Listen for new scroll events
  document.addEventListener('scroll', storeScroll)

  // Update scroll position for first time
  storeScroll()

  const hamburger = document.querySelector('.nav-main-mobile .hamburger-icon')
  const header = document.querySelector('.header')

  hamburger.addEventListener('click', () => {
    header.classList.toggle('open')
  })
}
