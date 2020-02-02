export function request(url, params, onProgress) {
  const defaults = {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  };

  return new Promise((resolve, reject) => {
    const options = { ...defaults, ...params };

    const xhr = new XMLHttpRequest();
    xhr.open(options.method, options.params ? `${url}?${queryParams(options.params)}` : url, true);
    xhr.addEventListener('load', () => {
      if (xhr.status >= 200 && xhr.status < 300) {
        try {
          resolve(xhr.responseText && JSON.parse(xhr.responseText));
        } catch (e) {
          reject(xhr.responseText);
        }
      } else {
        reject(xhr);
      }
    });

    for (const k in options.headers) {
      xhr.setRequestHeader(k, options.headers[k]);
    }

    if (onProgress) {
      xhr.upload.onprogress = e => {
        if (e.lengthComputable) {
          const percent = (e.loaded / e.total) * 100;

          onProgress(percent | 0);
        }
      };
    }

    if (options.body) {
      xhr.send(options.body);
    } else {
      xhr.send();
    }
  });
}
function queryParams(data = {}) {
  return Object.keys(data)
    .map(key => {
      const value = data[key];

      if (Array.isArray(value)) {
        const k = `${key}[]`;
        const v = value.map(encodeURIComponent).join(`&${k}=`);
        return `${k}=${v}`;
      }

      return `${encodeURIComponent(key)}=${encodeURIComponent(value)}`;
    })
    .join('&');
}
