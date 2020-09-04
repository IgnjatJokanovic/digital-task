const createCookie = cookieValue => {
    const date = new Date();
    date.setTime(date.getTime() + 1 * 24 * 60 * 60 * 1000);
    document.cookie =
        "token" + "=" + cookieValue + "; path=/; expires=" + date.toGMTString();
};

const fetchCookie = () => {
    let name = "token" + "=";
    let allCookieArray = document.cookie.split(";");

    for (let i = 0; i < allCookieArray.length; i++) {
        let temp = allCookieArray[i].trim();

        if (temp.indexOf(name) === 0) {
            return temp.substring(name.length, temp.length);
        }
    }

    return "";
};

const isAuthenticated = () => {
    return fetchCookie("token").length > 0;
};

export { createCookie, fetchCookie, isAuthenticated };
