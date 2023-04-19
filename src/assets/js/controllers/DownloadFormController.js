export const DownloadFormController = () => {
  const postPage = document.querySelector(".single-post");

  if (!postPage) {
    return;
  }

  const wpcf7 = document.querySelector(".wpcf7");

  wpcf7.addEventListener(
    "wpcf7mailsent",
    function () {
      showDownload();
    },
    false
  );

  // // TODO: FOR TESTING PURPOSE
  // wpcf7.addEventListener(
  //   "wpcf7submit",
  //   function (event) {
  //     showDownload();
  //   },
  //   false
  // );
};

const showDownload = () => {
  const p = nucleon_params;
  const pdfLink = p.pdf_link;
  const download = p.download;

  const decodedLink = atob(pdfLink);

  const postDownloadTitle = document.querySelector(
    ".post_download__extra-information"
  );
  const postDownloadForm = document.querySelector(".post_download__form");
  const postDownloadButton = document.querySelector(".post_download__button");

  postDownloadTitle.style.display = "none";
  postDownloadForm.style.display = "none";

  const downloadTitle = document.createElement("h2");
  downloadTitle.className = "download-title";
  downloadTitle.innerText = download.download_title;

  const downloadText = document.createElement("p");
  downloadText.className = "download-text";
  downloadText.innerText = download.download_text;

  const buttonEl = document.createElement("a");
  buttonEl.className = "download-link";
  buttonEl.href = decodedLink;
  buttonEl.download = true;

  const buttonTextEl = document.createElement("span");
  buttonTextEl.innerText = download.download_button;
  buttonEl.appendChild(buttonTextEl);

  postDownloadButton.appendChild(downloadTitle);
  postDownloadButton.appendChild(downloadText);
  postDownloadButton.appendChild(buttonEl);
};
