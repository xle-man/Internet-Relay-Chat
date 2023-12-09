import { checkNickname, generateNickname } from "./checkNickname.js";
import { insertNewMessage } from "./insertNewMessage.js";
import { getData } from "./alp.js";

const elChat = document.getElementById("chat");
const elNewMsg = document.getElementById("new-msg");
const elSvgSend = document.getElementById("svg-send");

// let nickname = prompt("Nickname:") || (await generateNickname());
let nickname = generateNickname();
nickname = await checkNickname(nickname);

elNewMsg.focus();
elNewMsg.addEventListener("keydown", (e) => {
  if (e.key === "Enter" && elNewMsg.value.trim() !== "") {
    insertNewMessage(elNewMsg, nickname);
  }
});

elSvgSend.addEventListener("click", () => {
  elNewMsg.value.trim() !== "" && insertNewMessage(elNewMsg, nickname);
});

getData(elChat);
