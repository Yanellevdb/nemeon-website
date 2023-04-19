import { lazyLoadImages } from './utils/Utils'
import objectFitImages from 'object-fit-images'
// import Modernizr from 'modernizr';
import { LoadMoreController } from './controllers/LoadMoreController.js'
import { HeaderController } from './controllers/HeaderController.js'
import { DownloadFormController } from './controllers/DownloadFormController.js'

/* Constructor for app
 *
 * @return {void}
 */
const init = () => {
  objectFitImages()
  LoadMoreController()
  HeaderController()
  DownloadFormController()
}

window.addEventListener('load', init, false)
