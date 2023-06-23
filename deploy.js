const FtpDeploy = require("ftp-deploy");
const process = require("process");

let domain = process.argv[2];

var ftpDeploy = new FtpDeploy();
var config = {
    user: "dev_geeks",
    password: "EM0Fll6ahZ85w9FO",
    host: "91.223.123.137",
    port: 21,
    localRoot: "./",
    remoteRoot: `/www/${domain}`,
    include: [
        "content/**/*",
        "routes/**/*",
        "storage/**/*",
        "system/**/*",
        ".htaccess",
        "system.json",
        "*.php",
    ],
    exclude: [".DS_Store", "yarn.lock", ".gitignore", "node_modules/**/*", "vue/**/*"],
    deleteRemote: true,
    forcePasv: true,
    sftp: false,
};

if (domain) {
    ftpDeploy
        .deploy(config)
        .then((res) => console.log("finished:", res))
        .catch((err) => console.log(err));
} else {
    console.log("Error. The domain is not specified");
}


ftpDeploy.on("uploaded", function (data) {
    console.log(data);
});
ftpDeploy.on("log", function (data) {
    console.log(data);
});
ftpDeploy.on("upload-error", function (data) {
    console.log(data.err);
});
