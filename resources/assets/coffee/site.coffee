###*
# @param {string} body id="body"
# @param {string} bottom id="bottom"
###
window.fixBottom = (body = 'body', bottom = 'bottom') ->
    infoHeight = document.getElementById(body).scrollHeight
    bottomHeight = document.getElementById(bottom).scrollHeight
    allHeight = document.documentElement.clientHeight

    bottom = document.getElementById(bottom)

    if infoHeight + bottomHeight < allHeight
        bottom.style.position = 'absolute'
        bottom.style.bottom = '0'
        return
    else
        bottom.style.position = ''
        bottom.style.bottom = ''
        return