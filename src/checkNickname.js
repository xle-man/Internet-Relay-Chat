export const checkNickname = async (nickname) => {
  const response = await fetch(
    `./src/server/checkNickname.php?nickname=${nickname}`
  );
  const result = await response.json();

  if (!result["result"]) {
    nickname = prompt("This nickname already exists. Type new one:");
    checkNickname(nickname);
    return;
  }

  console.log(nickname);
  return nickname;
};

export const generateNickname = () => {
  return `nickname${Math.floor(Math.random() * 100 + 1)}`;
};
