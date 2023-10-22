import AWS from "aws-sdk";
// const AWS = require("aws-sdk");

export const sendSMS = (details) => {
    console.log("Send SMS");
    console.log(details);

    const { access_id, secret_access, region } = details;

    AWS.config = new AWS.Config({
        accessKeyId: access_id,
        secretAccessKey: secret_access,
        region,
    });

    const sqs = new AWS.SQS({
        apiVersion: "2012-11-05",
    });

    let params = {
        DelaySeconds: 10,
        MessageAttributes: {
            Title: {
                DataType: "String",
                StringValue: "AWS SQS",
            },
            Author: {
                DataType: "String",
                StringValue: "Shahmir Khan Jadoon",
            },
            Mobile: {
                DataType: "Number",
                StringValue: "123456",
            },
        },
        MessageBody:
            '{\n  id: 123,\n  clientMessage: "An amount of Rs 25,000 has been paid",\n}',
        QueueUrl:
            "https://sqs.ap-southeast-1.amazonaws.com/218822377018/ajwa-gardens-sms",
    };

    sqs.sendMessage(params, (err, data) => {
        if (err) {
            console.log("Error");
            console.log(err);
        } else {
            console.log("Success");
            console.log(data.MessageId);
        }
    });
};
