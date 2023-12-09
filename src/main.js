import { checkNickname, generateNickname } from "./checkNickname.js";
import { insertNewMessage } from "./insertNewMessage.js";
import { getData } from "./alp.js";

const elChat = document.getElementById("chat");
const elNewMsg = document.getElementById("new-msg");
const elSvgSend = document.getElementById("svg-send");

// let nickname = prompt("Nickname:") || generateNickname();
let nickname = generateNickname();
nickname = await checkNickname(nickname);

const checkForCommands = (elNewMsg) => {
  const command = elNewMsg.value.split(" ");

  if (command[0] === "/quit") {
    window.location.reload();
    elNewMsg.value = "";
  }
  if (command[0] === "/color" && command[1]) {
    insertNewMessage(elNewMsg, nickname, true);
    elNewMsg.value = "";
  } else if (command[0] === "/nickname" && command[1]) {
    insertNewMessage(elNewMsg, nickname, true);
    nickname = command[1];
    elNewMsg.value = "";
  } else if (!["/color", "/nickname"].includes(command[0])) {
    insertNewMessage(elNewMsg, nickname, false);
    elNewMsg.value = "";
  }
};

elNewMsg.focus();
elNewMsg.addEventListener("keydown", (e) => {
  if (e.key === "Enter" && elNewMsg.value.trim() !== "") {
    checkForCommands(elNewMsg);
  }
});

elSvgSend.addEventListener("click", () => {
  elNewMsg.value.trim() !== "" && checkForCommands(elNewMsg);
});

getData(elChat);
