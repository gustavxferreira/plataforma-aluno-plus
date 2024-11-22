export async function removeItemsByPrefixes(prefixes) {
    for (let i = localStorage.length - 1; i >= 0; i--) {

      const key = localStorage.key(i);
  
      if (key && prefixes.some((prefix) => key.startsWith(prefix))) {
        // Remove o item do localStorage
        localStorage.removeItem(key);
      }
    }
  }