const l = nucleon_params.loadmore;

export const LoadMoreController = () => {
  loadMoreButton();
};

const loadMoreButton = () => {
  $(document).on("click", "#loadmore", (e) => {
    const button = $(e.currentTarget);
    const buttonText = $(e.currentTarget).find("span");

    const data = {
      action: "loadmore",
      query: l.posts,
      page: l.current_page,
      is_search: l.is_search,
      lang: l.lang,
    };

    $.ajax({
      url: timber_params.ajaxurl,
      data: data,
      type: "POST",
      beforeSend: (xhr) => {
        buttonText.text(l.loading_text);
        $("#posts").addClass("loading");
        button.addClass("loading");
      },
      success: (data) => {
        if (data) {
          $("#posts").append(data);
          buttonText.text(l.button_text);
          button.removeClass("loading");
          l.current_page++;
          if (l.current_page == l.max_page) {
            button.remove();
          }
        } else {
          button.remove();
        }

        $("#posts").removeClass("loading");
      },
      error: (_MLHttpRequest, _textStatus, _errorThrown) => {
        console.dir(_errorThrown);
      },
    });
  });
};
