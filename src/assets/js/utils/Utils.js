import LazyLoad from 'vanilla-lazyload/dist/lazyload'

export const lazyLoadImages = () => {
  var myLazyLoad = new LazyLoad({
    elements_selector: '.lazy',
  })
}

/**
 * Convert rem to pixels
 *
 * @param {Number} rem
 */
// eslint-disable-next-line import/prefer-default-export
export const convertRemToPixels = (rem) =>
  rem * parseFloat(getComputedStyle(document.documentElement).fontSize)
