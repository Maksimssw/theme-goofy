const addParams = {
  pid: {
    value: "",
  },
  c: {
    value: "",
  },
  ad: {
    match: "af_ad",
  },
  adset_id: {
    match: "af_adset_id",
  },
  channel: {
    match: "af_channel",
  },
  // Trackers ID
  fbq: {
    match: "af_adset",
  },
  ttq: {
    match: "af_adset"
  },
  snaptr:{
    match: "af_adset"
  },
  gtag: {
    match: "af_adset"
  },
  vk:{
    match: "af_adset"
  },
  // Click ID
  fbclid: {
    match: "af_c_id",
  },
  ttclid: {
    match: "af_c_id",
  },
  ScCid: {
    match: "af_c_id",
  },
  gclid: {
    match: "af_c_id",
  },
};

function getCookie(name) {
  var matches = document.cookie.match(
    new RegExp(
      "(?:^|; )" +
        name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
        "=([^;]*)"
    )
  );
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

window.addEventListener("DOMContentLoaded", () => {
  let urlParams = new URLSearchParams(window.location.search);
  let links = document.querySelectorAll(".target-link");
  if (links) {
    for (let key in addParams) {
      if (getCookie(key) && addParams[key].cookie) {
        addParams[key].value = getCookie(key);
      } else if (urlParams.get(key)) {
        addParams[key].value = urlParams.get(key);
      }
    }
    links.forEach((link) => {
      let href = link.href;

      for (let key in addParams) {
        if (addParams[key].value){
          href +=
            (href.includes("?") ? "&" : "?") +
            `${addParams[key].match ? addParams[key].match : key}=${
              addParams[key].value
            }`;
        }
      }
      link.href = href;
    });
  }
});