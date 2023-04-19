import $ from 'jquery'
const l = nucleon_params.loadmore

export const LoadMoreController = () => {
  loadMoreButton()
}

const loadMoreButton = () => {
  const loadMore = document.querySelector('#loadmore')

  if (!loadMore) return

  loadMore.addEventListener('click', (e) => {
    const button = e.currentTarget
    const buttonText = e.currentTarget.querySelectorAll('span')

    const data = {
      action: 'loadmore',
      query: l.posts,
      page: l.current_page,
      is_search: l.is_search,
      lang: l.lang,
    }

    $.ajax({
      url: nucleon_params.ajaxurl,
      data: data,
      type: 'POST',
      beforeSend: (xhr) => {
        buttonText.innerHTML = l.loading_text

        posts.classList.add('loading')
        button.classList.add('loading')
      },
      success: (data) => {
        if (data) {
          $('#posts').append(data)
          buttonText.innerHTML = l.button_text
          button.classList.remove('loading')
          l.current_page++
          if (l.current_page == l.max_page) {
            button.remove()
          }
        } else {
          button.remove()
        }

        const posts = document.querySelector('#posts')
        posts.classList.remove('loading')
      },
      error: (_MLHttpRequest, _textStatus, _errorThrown) => {
        console.dir(_errorThrown)
      },
    })
  })
}
