export const checkNickname = async (nickname) => {
  if (nickname.trim() === "") {
    nickname = prompt("Nickname can't be empty. Type new one:");
    return checkNickname(nickname);
  }

  const response = await fetch(
    `./src/server/check_nickname.php?nickname=${nickname}`
  );
  const result = await response.json();

  if (!result["result"]) {
    nickname = prompt("This nickname already exists. Type new one:");
    return checkNickname(nickname);
  } else {
    return [nickname, result["lastID"]];
  }
};

export const generateNickname = async () => {
  return `nickname${Math.floor(Math.random() * 100 + 1)}`;
};
