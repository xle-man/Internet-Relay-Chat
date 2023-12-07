import { checkNickname, generateNickname } from "./checkNickname.js";
import { insertNewMessage } from "./insertNewMessage.js";

const elChat = document.getElementById("chat");
const elNewMsg = document.getElementById("new-msg");

let nickname = prompt("Nickname:") || generateNickname();
nickname = await checkNickname(nickname);

elNewMsg.focus();
elNewMsg.addEventListener("keydown", (e) => {
  e.key === "Enter" && insertNewMessage(elNewMsg, nickname);
});

const getData = async () => {
  const response = await fetch("./src/server/alp.php");
  const result = await response.json();
  if (result.status) {
    elChat.innerHTML += result.data;
    console.log(elChat.innerHTML);
  }
  getData();
};

getData();
