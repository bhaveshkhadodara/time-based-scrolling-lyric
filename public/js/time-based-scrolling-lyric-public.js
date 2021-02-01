(function($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    $(function() {
        function parseLyric(text) {
            //Split lyrics by line
            let lyricArr = text.split('\\n');
            //console.log(lyricArr)//0: "[ti: ]" "[ar: ]"...
            let result = []; //Create a new array to store the final result
            //Traverse the divided lyrics array, fill the formatted time node and lyrics into the result array
            var i;
            for (i = 0; i < lyricArr.length; i++) {
                let playTimeArr = lyricArr[i].match(/\[\d{2}:\d{2}((\.|\:)\d{2})\]/g); //Regular match play time
                let lineLyric = "";
                if (lyricArr[i].split(playTimeArr).length > 0) {
                    lineLyric = lyricArr[i].split(playTimeArr);
                }

                if (playTimeArr != null) {
                    for (let j = 0; j < playTimeArr.length; j++) {
                        let time = playTimeArr[j].substring(1, playTimeArr[j].indexOf("]")).split(":");
                        //Array fill
                        result.push({
                            time: (parseInt(time[0]) * 60 + parseFloat(time[1])).toFixed(4),
                            content: String(lineLyric).substr(1)
                        });
                    }
                }


            }
            return result;
        }


        let text = $("#lycrics").val();

        let audio = document.querySelector('audio');

        let result = parseLyric(text); //Perform lyc analysis


        // Display the generated data on the interface
        let $ul = $("<ul></ul>");
        for (let i = 0; i < result.length; i++) {
            let $li = $("<li></li>").text(result[i].content);
            $ul.append($li);
        }
        $(".bg").append($ul);

        let lineNo = 0; // Current line lyrics
        let preLine = 6; // Start to scroll lyrics after playing 6 lines
        let lineHeight = -30; // the distance of each scroll

        // Scroll to play, highlight the lyrics, add class name active
        function highLight() {
            let $li = $(".bg ul li");
            $li.eq(lineNo).addClass("active").siblings().removeClass("active");
            if (lineNo > preLine) {
                $ul.stop(true, true).animate({ top: (lineNo - preLine) * lineHeight });
            }
        }

        highLight();

        // keep rendering while playing
        audio.addEventListener("timeupdate", function() {
            if (lineNo == result.length) return;
            if ($(".bg ul li").eq(0).hasClass("active")) {
                $("ul").css("top", "0");
            }
            lineNo = getLineNo(audio.currentTime);
            highLight();
            lineNo++;
        });

        // When fast forwarding or rewinding, find the nearest result[i].time
        function getLineNo(currentTime) {
            if (currentTime >= parseFloat(result[lineNo].time)) {
                // fast forward
                for (let i = result.length - 1; i >= lineNo; i--) {
                    if (currentTime >= parseFloat(result[i].time)) {
                        return i;
                    }
                }
            } else {
                // back
                for (let i = 0; i <= lineNo; i++) {
                    if (currentTime <= parseFloat(result[i].time)) {
                        return i - 1;
                    }
                }
            }
        }

        //Automatically return to the beginning after playing
        audio.addEventListener("ended", function() {
            lineNo = 0;
            highLight();
            audio.play();
            $("ul").css("top", "0");
        });
    });
})(jQuery);